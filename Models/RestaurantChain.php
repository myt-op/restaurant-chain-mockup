<?php
namespace Models;

class RestaurantChain extends Company implements FileConvertible {

    private int $chainId;
    private array $locations;      // RestaurantLocation[]
    private string $cuisineType;
    private int $totalLocations;
    private bool $hasDriveThru;
    private int $establishedYear;
    private string $parentCompany;

    public function __construct(
        // Company の引数（親クラス）
        string $name,
        int $foundedYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPublic,

        // 自分のプロパティ
        int $chainId,
        array $locations,
        string $cuisineType,
        int $totalLocations,
        bool $hasDriveThru,
        int $establishedYear,
        string $parentCompany
    ){
        parent::__construct(
            $name, $foundedYear, $description, $website,
            $phone, $industry, $ceo, $isPublic
        );

        $this->chainId = $chainId;
        $this->locations = $locations;
        $this->cuisineType = $cuisineType;
        $this->totalLocations = $totalLocations;
        $this->hasDriveThru = $hasDriveThru;
        $this->establishedYear = $establishedYear;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string{
        $companyInfo = parent::toString();

        return sprintf(
            "%s\n".
            "Chain ID: %d\n".
            "Cuisine Type: %s\n".
            "Total Locations: %d\n".
            "Drive Thru: %s\n".
            "Established Year: %d\n".
            "Parent Company: %s",
            $companyInfo,
            $this->chainId,
            $this->cuisineType,
            $this->totalLocations,
            $this->hasDriveThru ? "Yes" : "No",
            $this->establishedYear,
            $this->parentCompany
        );
    }

    public function toHTML(): string {

        $companyHTML = parent::toHTML();

        $locationsHtml = "";
        foreach ($this->locations as $loc) {
            $locationsHtml .= $loc->toHTML();
        }

        return "
            <div class='chain-card'>
                $companyHTML

                <h2>Restaurant Chain Info</h2>

                <p><strong>Chain ID:</strong> {$this->chainId}</p>
                <p><strong>Cuisine Type:</strong> {$this->cuisineType}</p>
                <p><strong>Total Locations:</strong> {$this->totalLocations}</p>
                <p><strong>Drive Thru:</strong> ".($this->hasDriveThru ? "Yes" : "No")."</p>
                <p><strong>Established Year:</strong> {$this->establishedYear}</p>
                <p><strong>Parent Company:</strong> {$this->parentCompany}</p>

                <h2>Locations</h2>
                <div class='location-list'>
                    $locationsHtml
                </div>
            </div>
        ";
    }

    public function toMarkdown(): string {
    
        $companyMarkdown = parent::toMarkdown();

        
        $locationsMarkdown = "";
        foreach ($this->locations as $location) {
            $locationsMarkdown .= $location->toMarkdown() . "\n\n";
        }

        return sprintf(
            "%s\n\n".
            "### Restaurant Chain Info\n".
            "- Chain ID: %d\n".
            "- Cuisine Type: %s\n".
            "- Total Locations: %d\n".
            "- Drive Thru: %s\n".
            "- Established Year: %d\n".
            "- Parent Company: %s\n\n".
            "### Locations\n%s",
            
            $companyMarkdown,
            $this->chainId,
            $this->cuisineType,
            $this->totalLocations,
            $this->hasDriveThru ? "Yes" : "No",
            $this->establishedYear,
            $this->parentCompany,
            $locationsMarkdown
        );
    }

    public function toArray(): array {
        
        $companyArray = parent::toArray();

        
        $locationsArray = [];
        foreach ($this->locations as $loc) {
            $locationsArray[] = $loc->toArray();
        }

        
        return array_merge($companyArray, [
            "chainId" => $this->chainId,
            "cuisineType" => $this->cuisineType,
            "totalLocations" => $this->totalLocations,
            "hasDriveThru" => $this->hasDriveThru,
            "establishedYear" => $this->establishedYear,
            "parentCompany" => $this->parentCompany,
            "locations" => $locationsArray
        ]);


    }

    public function addLocation(RestaurantLocation $location): void{
        $this->locations[] = $location;
        $this->totalLocations++;

    }

    public function printLocations(): void{
        $locationsString = "";

        foreach($this->locations as $location){
            $locationsString .= $location->toString() . "\n";
            
        }

        printf("Total Location: %d\n".
                "Locations: \n%s",
                $this->totalLocations,
                $locationsString

            
            );
    }


    
}
