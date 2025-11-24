<?php 
namespace Models;

class RestaurantLocation implements FileConvertible{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $postalCode;
    private array $employees;
    private bool $isOpen;

    public function __construct(
        string $name, 
        string $address, 
        string $city,
        string $state,
        string $postalCode,
        array $employees,
        bool $isOpen
    ){
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->employees =$employees;
        $this->isOpen = $isOpen;

    }

    public function toString():string{
        $employeesString = "";
        foreach($this->employees as $employee){
            $employeesString .= $employee->toString() . "\n";
        }

        if ($employeesString === "") {
            $employeesString = "None\n";
        }

        return sprintf(
            "Name: %s\n".
            "Address: %s\n".
            "City: %s\n".
            "State: %s\n".
            "Postal Code: %s\n".
            "Employees: %s".
            "is Open: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->postalCode,
            $employeesString,
            $this->isOpen ? "Open" : "Closed"
            
        );
    }

    public function toHTML(): string {

        $employeeHTML = "";
        foreach ($this->employees as $emp) {
            $employeeHTML .= $emp->toHTML();
        }

        return "
            <div class='location-card'>
                <h3>{$this->name}</h3>
                <p>{$this->address}, {$this->city}, {$this->state} {$this->postalCode}</p>
                <p><strong>Status:</strong> ".($this->isOpen ? "Open" : "Closed")."</p>

                <h4>Employees</h4>
                <div class='employee-list'>
                    $employeeHTML
                </div>
            </div>
        ";
    }

    public function toMarkdown(): string{
        return sprintf(
            "### Location: %s
            - Address: %s, %s, %s %s
            - Status: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->postalCode,
            $this->isOpen ? "Open" : "Closed"
        );
    }

    public function toArray(): array{
        return [
            "name" => $this->name,
            "address" => $this->address,
            "city" => $this->city,
            "state" => $this->state,
            "postalCode" => $this->postalCode,
            "employees" => array_map(fn($e)=>$e->toArray(), $this->employees),
            "isOpen" => $this->isOpen
        ];
    }

    public function getName(): string{
        return $this->name;
    }
}