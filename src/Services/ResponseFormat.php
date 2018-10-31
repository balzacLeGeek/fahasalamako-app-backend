<?php
    namespace App\Services;
    use App\Entity\Pharmacy;
    use App\Entity\Medicament;

    class ResponseFormat
    {
        static function ListePharmacy(Pharmacy $pharmacy)
        {
            return [
                "id"     =>  $pharmacy->getId(),
                "nom"     =>  $pharmacy->getNom(),
                "adresse"     =>  $pharmacy->getAdresse(),
                "telephone"     =>  $pharmacy->getTelephone(),
                "email"     =>  $pharmacy->getEmail(),
                "cover"     =>  $pharmacy->getCover(),
                "coodonnees"     =>  [
                    "latitude"     =>  $pharmacy->getLatitude(),
                    "longitude"     =>  $pharmacy->getLongitude(),
                ]
            ];
        }

        // Medicaments
        static function ShowMedicament(Medicament $medicament)
        {            
            $category = $medicament->getCategory();
            $laboratory = $medicament->getLaboratory();
             
            return [
                "phar_id"     =>  $medicament->getPharmacy()->getId(),
                "id"     =>  $medicament->getId(),
                "reference"     =>  $medicament->getReference(),
                "nom"     =>  $medicament->getNom(),
                "prix"     =>  $medicament->getPrix(),
                "info"     =>  [
                    "indication"     =>  $medicament->getIndication(),
                    "posologie"     =>  $medicament->getPosologie(),
                    "contreIndication"     =>  $medicament->getContreIndication(),
                ],
                "dateExpiration"     =>  $medicament->getDateExpiration(),
                "cover"     =>  $medicament->getCover(),
                "poids"     =>  $medicament->getPoids(),
                "quantite"     =>  $medicament->getQuantite(),
                "cover"     =>  $medicament->getCover(),
                "category"     =>  [
                    "cat_id" => $category->getId(),
                    "cat_nom" => $category->getNom(),
                ],
                "laboratory"     =>  [
                    "lab_id" => $laboratory->getId(),
                    "lab_nom" => $laboratory->getNom(),
                ],
            ];
        }
    }
    