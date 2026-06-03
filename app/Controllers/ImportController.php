<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Exception;
class ImportController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function uploadVersion1()  // Version sans validation des données et du fichier
    {
        $model = new UserModel();
        $file = $this->request->getFile('csv_file');
        $handle = fopen($file->getTempName(), 'r');
        $headers = fgetcsv($handle, 0, ';');
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $data = array_combine($headers, $row);
            $model->insert($data);
        }
        fclose($handle);
        return redirect()->back()->with('success', 'Fichier importé avec succès.');
    }

    public function upload()  //version avec validation des données et du fichier, gestion des erreurs et affichage des erreurs dans la vue
    {
        $model = new UserModel();
        $file = $this->request->getFile('csv_file');
        try {

            $extension = $file->getExtension(); // Récupère l'extension du fichier
            if ($extension !== 'csv') {
                throw new Exception('Le fichier doit être un CSV');
            }
            $handle = fopen($file->getTempName(), 'r'); // Ouvre le fichier temporaire pour la lecture
            $headers = fgetcsv($handle, 0, ';');  // Lit la première ligne du fichier pour obtenir les en-têtes
            if (!$file->isValid()) {
                throw new Exception('Fichier invalide');
            }


            $expectedHeaders = [ // Les en-têtes attendus dans le fichier CSV
                'matricule',
                'nom',
                'prenom',
                'email',
                'filiere',
                'niveau'
            ];
            if ($headers !== $expectedHeaders) {
                throw new Exception(
                    'Structure du fichier incorrecte'
                );
            }
            $errors = [];
            $lineNumber = 1; // Pour suivre le numéro de ligne dans le fichier CSV
            while (($row = fgetcsv($handle, 0, ';')) !== false) { // Lit chaque ligne du fichier CSV


                $lineNumber++;
                if (count($headers) === count($row)) { // Vérifie que le nombre de colonnes correspond au nombre d'en-têtes
                    if (empty($row) || count($row) === [null]) { // Vérifie si la ligne est vide ou ne contient que des valeurs nulles
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Ligne vide ou contenant uniquement des valeurs nulles'
                        ];
                        continue;
                    }
                    if (count($headers) !== count($row)) { // Vérifie que le nombre de colonnes correspond au nombre d'en-têtes
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Nombre de colonnes incorrect sur la ligne ' . $lineNumber . ': attendu ' . count($headers) . ' mais trouvé ' . count($row)
                        ];
                    }


                    $data = array_combine($headers, $row);  // Combine les en-têtes avec les valeurs de la ligne pour créer un tableau associatif
                    if (empty($data['matricule'])) {
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Matricule manquant'
                        ];
                        continue;
                    }

                    if (empty($data['filiere'])) {
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Filière manquante'
                        ];
                        continue;
                    }

                    if (empty($data['niveau'])) {
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Niveau manquant'
                        ];
                        continue;
                    }
                    if (empty($data['nom'])) {
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Nom manquant'
                        ];
                        continue;
                    }
                    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Email invalide'
                        ];
                        continue;
                    }

                    $existing = $model
                        ->where('email', $data['email'])
                        ->first();

                    if ($existing) { // Vérifie si un utilisateur avec le même email existe déjà dans la base de données
                        $errors[] = [
                            'ligne' => $lineNumber,
                            'message' => 'Email déjà existant'
                        ];
                        continue;
                    }
                    $model->insert($data);

                }
            }
            fclose($handle);
            if (!empty($errors)) {
                return redirect()->back()->with('errors', $errors);
            }
            return redirect()->back()->with('success', 'Fichier importé avec succès.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}