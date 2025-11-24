<?php 
namespace Models;

use DateTime;
use Models\FileConvertible;

class User implements FileConvertible{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $hashedPassword;
    protected string $phoneNumber;
    protected string $address;
    protected DateTime $birthDate;
    protected DateTime $membershipExpirationDate;
    protected string $role;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, $address, 
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role
    ){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
        
    }

    public function login(string $password): bool{
        return password_verify($password, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber): void{
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate): void{
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword): void{
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool{
        $currentTime = new DateTime();
        return $currentTime > $this->membershipExpirationDate;
    }

    public function toString(): string{
        return sprintf(
            "User ID: %d\nName: %s %s\nEmail: %s\nPhone Number: %s\nAddress: %s\nBirth Date: %s\nMembership Expiration Date: %s\nRole: %s",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format("Y-m-d"),
            $this->membershipExpirationDate->format("Y-m-d"),
            $this->role
        );
    }

    public function toHTML(): string{
        return sprintf("
            <div class = 'user-card'>

                <div class = 'avatar'>SAMPLE</div>
                <h2>%s %s</h2>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                <p>Birth Date: %s</p>
                <p>Membership Expiration Date: %s</p>
                <p>Role: %s</p>
            
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format("Y-m-d"),
            $this->membershipExpirationDate->format("Y-m-d"),
            $this->role
        );
    } 

    public function toMarkdown(): string{
    return sprintf(
    "## User: %s %s
    - Email: %s
    - Phone Number: %s
    - Address: %s
    - Birth Date: %s
    - Is Active: %s
    - Role: %s",
        $this->firstName,
        $this->lastName,
        $this->email,
        $this->phoneNumber,
        $this->address,
        $this->birthDate->format('Y-m-d'),
        ($this->hasMembershipExpired() ? 'No' : 'Yes'),
        $this->role
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
            "role" => $this->role

        ];
    }

    

}