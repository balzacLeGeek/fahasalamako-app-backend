<?php
    namespace App\Services;
    use App\Entity\Pharmacie;
    use App\Entity\Medicament;

    class ResponseFormat
    {
        static function ListePharmacie($isGarde, Pharmacie $pharmacie)
        {
            return [
                "id"     =>  $pharmacie->getId(),
                "nom"     =>  $pharmacie->getNom(),
                "adresse"     =>  $pharmacie->getAdresse(),
                "telephone"     =>  $pharmacie->getTelephone(),
                "coodonnees"     =>  [
                    "latitude"     =>  $pharmacie->getLatitude(),
                    "longitude"     =>  $pharmacie->getLongitude(),
                ],
                "garde" => $isGarde,
            ];
        }

        // Medicaments
        static function ShowMedicament($pharmacieListe, Medicament $medicament)
        {
            $pharmacies = [];
            foreach ($pharmacieListe as $pharmacie) {
                $pharmacies[] = [
                    "id_produit" => $pharmacie->getId(),
                    "id"     =>  $pharmacie->getPharmacie()->getId(),
                    "nom"     =>  $pharmacie->getPharmacie()->getNom(),
                ];
            }
            return [
                "id"     =>  $medicament->getId(),
                "codeATC"     =>  $medicament->getCodeATC()->getCode(),
                "nom"     =>  $medicament->getNom(),
                "prix"     =>  28585,
                "presentation"  =>  $medicament->getPresentation(),
                "infoGenerale"  =>  $medicament->getInfoGenerale(),
                "principesActifs"     =>  $medicament->getPrincipesActifs()->getNom(),
                "expicients"     =>  $medicament->getExpicients(),
                "aspectForme"     =>  $medicament->getAspectForme(),
                "casUtilisation"     =>  $medicament->getCasUtilisation(),
                "posologie"     =>  $medicament->getPosologie(),
                "effet"     =>  $medicament->getEffet(),
                "contreIndication"     =>  $medicament->getContreIndication(),
                "pathologie"     =>  [
                    "id"  => $medicament->getPathologie()->getId(),
                    "nom"  => $medicament->getPathologie()->getNom(),
                ],
                "laboratoire"     =>  [
                    "id" => $medicament->getLaboratoire()->getId(),
                    "nom" => $medicament->getLaboratoire()->getNom(),
                ],
                "pharmacies" => $pharmacies,
            ];
        }
    }
    