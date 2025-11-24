<?php 
namespace Models;

class Company implements FileConvertible{
    private string $name;
    private int $foundedYear;
    private string $description;
    private string $website;
    private string $phone;
    private string $industry;
    private string $ceo;
    private bool $isPublic;


    public function __construct(
        string $name,
        int $foundedYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPublic
    ){
        $this->name = $name;
        $this->foundedYear = $foundedYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPublic = $isPublic;
        
    }

    public function toString(): string{
        return sprintf("Name: %s\nFounded Year: %d\nDescription: %s\nWebsite: %s\nPhone: %s\nIndustry: %s\nCEO: %s\n is Public: %s",
            $this->name,
            $this->foundedYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPublic ? "Yes" : "No"
    );
    }

    public function toHTML(): string{
        return sprintf(
            "<div class = 'company-info'>
                <h2>Name: %s</h2>
                <p>Founded Year: %d</p>
                <p>Description: %s</p>
                <p>Website: %s</p>
                <p>Phone: %s</p>
                <p>Industry: %s</p>
                <p>CEO: %s</p>
                <p>is Public: %s</p>
            </div>",
            
            $this->name,
            $this->foundedYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPublic ? "Yes" : "No"
            
        );
    }

    public function toMarkdown(): string{
    return sprintf(
    "## Name: %s
    - Founded Year: %d
    - Description: %s
    - Website: %s
    - Phone: %s
    - Industry: %s
    - CEO: %s
    - is Public: %s
    ",
    $this->name,
    $this->foundedYear,
    $this->description,
    $this->website,
    $this->phone,
    $this->industry,
    $this->ceo,
    $this->isPublic ? "Yes" : "No"
    );
    }

    public function toArray(): array{
        return [
            "name" => $this->name,
            "foundedYear" => $this->foundedYear,
            "description" => $this->description,
            "website" => $this->website,
            "phone" => $this->phone,
            "industry" => $this->industry,
            "ceo" => $this->ceo,
            "isPublic" => $this->isPublic
        ];
    }
}