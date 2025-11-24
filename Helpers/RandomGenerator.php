<?php
namespace Helpers;
use Models\Employee;
use Models\RestaurantLocation;
use Models\RestaurantChain;

use Faker\Factory;

class RandomGenerator{
    public static function employee(): Employee{
        $faker = Factory::create();

        return new Employee(
            $faker->randomNumber(), 
            $faker->firstName(), 
            $faker->lastName(),
            $faker->email(), 
            $faker->password(), 
            $faker->phoneNumber(),
            $faker->address(), 
            $faker->dateTimeThisCentury(), 
            $faker->dateTimeBetween("-10 years", "+20 years"),
            $faker->randomElement(["admin", "user", "editor"]),

            // ← ここから Employee 独自のプロパティ
            $faker->jobTitle(),                     // jobTitle
            $faker->randomFloat(2, 2000, 8000),     // salary
            $faker->dateTimeBetween("-5 years", new \DateTime()), // startDate
            
            // awards (0〜3個ランダム)
            $faker->randomElements(
                ["Best Employee", "Top Sales", "5 Years Service", "MVP"],
                rand(0, 3)
            ));
    }

    public static function location(): RestaurantLocation {
        $faker = Factory::create();

        // ランダム従業員（3〜10人）
        $employees = [];
        $numEmployees = rand(3, 10);

        for ($i = 0; $i < $numEmployees; $i++) {
            $employees[] = self::employee();
        }

        return new RestaurantLocation(
            $faker->company(),              // name
            $faker->streetAddress(),        // address
            $faker->city(),                 // city
            $faker->state(),                // state
            $faker->postcode(),             // postalCode
            $employees,                     // employees
            $faker->boolean()               // isOpen
        );
    }


    public static function locations(int $min, int $max): array {
        $faker = Factory::create();

        $locations = [];
        $numLocations = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numLocations; $i++) {
            $locations[] = self::location();
        }

        return $locations;
    }

    public static function chain(): RestaurantChain {
        $faker = Factory::create();

        // ランダムなロケーションを 3〜8 店舗作成
        $locations = self::locations(3, 8);

        return new RestaurantChain(
            // Company の情報
            $faker->company(),                     // name
            $faker->year(),                        // foundedYear
            $faker->catchPhrase(),                 // description
            $faker->url(),                         // website
            $faker->phoneNumber(),                 // phone
            $faker->randomElement([
                "Food", "Restaurant", "Hospitality", "Retail"
            ]),                                     // industry
            $faker->name(),                        // CEO
            $faker->boolean(),                     // isPublic

            // RestaurantChain の独自情報
            $faker->unique()->randomNumber(),      // chainId
            $locations,                            // locations
            $faker->randomElement([
                "American", "Italian", "Mexican", "Asian", "Cafe", "BBQ"
            ]),                                     // cuisineType
            count($locations),                      // totalLocations
            $faker->boolean(),                      // hasDriveThru
            $faker->year(),                         // establishedYear
            $faker->company()                       // parentCompany
        );
    }

    
}