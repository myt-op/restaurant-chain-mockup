<?php 
namespace Models;

use Models\FileConvertible;
use Models\User;

use DateTime;

class Employee extends User implements FileConvertible{
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $email, 
        string $password, 
        string $phoneNumber, 
        $address, 
        DateTime $birthDate, 
        DateTime $membershipExpirationDate, 
        string $role,
        string $jobTitle,
        float $salary,
        DateTime $startDate,
        array $awards
    ){
        parent::__construct(
            $id, 
            $firstName, 
            $lastName, 
            $email, 
            $password, 
            $phoneNumber, 
            $address, 
            $birthDate, 
            $membershipExpirationDate, 
            $role
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function toString(): string{
        return sprintf(
            "ID: %d, Job Title: %s, %s %s, Start Date: %s",
            $this->id,
            $this->jobTitle,
            $this->firstName,
            $this->lastName,
            $this->startDate->format("Y-m-d")
        );
    }

   public function toHTML(): string {
    return "
        <div class='employee-card'>
            <p><strong>{$this->firstName} {$this->lastName}</strong></p>
            <p>Job Title: {$this->jobTitle}</p>
            <p>Salary: {$this->salary}</p>
            <p>Start Date: {$this->startDate->format('Y-m-d')}</p>

            <p>Awards:</p>
            <ul>".
            implode("", array_map(fn($a)=>"<li>$a</li>", $this->awards))
            ."</ul>
        </div>
    ";
}


    public function toMarkdown(): string{
        $awardsMarkdown = "";

        if (empty($this->awards)){
            $awardsMarkdown = "- None";
        }else{
            foreach($this->awards as $award){
                $awardsMarkdown.= "- {$award}\n";
            }
        }
        
        return sprintf(
        "## Employee: %s %s
        - Job Title: %s
        - Salary: %.2f
        - Start Date: %s
        - Awards:
        %s    
        ",

        $this->firstName,
        $this->lastName,
        $this->jobTitle,
        $this->salary,
        $this->startDate->format("Y-m-d"),
        $awardsMarkdown

        );
    }

    public function toArray(): array{
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email,
            "phoneNumber" => $this->phoneNumber,
            "address" => $this->address,
            "birthDate" => $this->birthDate->format("Y-m-d"),
            "isActive" => !$this->hasMembershipExpired(),
            "role" => $this->role,
            "jobTitle" => $this->jobTitle,
            "salary" => $this->salary,
            "startDate" => $this->startDate->format("Y-m-d"),
            "awards" => $this->awards
        ];
    }

}