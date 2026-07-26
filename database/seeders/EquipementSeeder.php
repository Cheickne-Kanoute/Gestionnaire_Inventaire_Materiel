<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipements = [
            // PC & Ordinateurs Portables
            [
                'nom' => 'MacBook Pro M2 Max - Direction',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.15',
                'date_acquisition' => '2024-01-15',
                'statut' => 'Actif',
                'prix' => 2150000, // 2 150 000 FCFA
            ],
            [
                'nom' => 'Dell Latitude 5540 - RH',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.20',
                'date_acquisition' => '2023-11-10',
                'statut' => 'Actif',
                'prix' => 750000, // 750 000 FCFA
            ],
            [
                'nom' => 'Lenovo ThinkPad X1 - Dev Lead',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.21',
                'date_acquisition' => '2024-02-01',
                'statut' => 'Actif',
                'prix' => 980000, // 980 000 FCFA
            ],
            [
                'nom' => 'HP EliteBook 840 G8 - Comptabilité',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.25',
                'date_acquisition' => '2023-08-14',
                'statut' => 'En maintenance',
                'prix' => 650000, // 650 000 FCFA
            ],
            [
                'nom' => 'iMac 24" M3 - Studio Design',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.30',
                'date_acquisition' => '2024-03-10',
                'statut' => 'Actif',
                'prix' => 1350000, // 1 350 000 FCFA
            ],
            [
                'nom' => 'Dell OptiPlex 7090 - Réception',
                'type' => 'PC',
                'adresse_ip' => '192.168.1.32',
                'date_acquisition' => '2023-05-22',
                'statut' => 'Actif',
                'prix' => 480000, // 480 000 FCFA
            ],

            // Serveurs
            [
                'nom' => 'Serveur Dell PowerEdge R750 - Base de Données',
                'type' => 'Serveur',
                'adresse_ip' => '192.168.1.2',
                'date_acquisition' => '2023-03-15',
                'statut' => 'Actif',
                'prix' => 4500000, // 4 500 000 FCFA
            ],
            [
                'nom' => 'Serveur HP ProLiant DL380 Gen10 - Sauvegarde',
                'type' => 'Serveur',
                'adresse_ip' => '192.168.1.3',
                'date_acquisition' => '2023-06-18',
                'statut' => 'Actif',
                'prix' => 3800000, // 3 800 000 FCFA
            ],
            [
                'nom' => 'Serveur Virtualisation VMware ESXi',
                'type' => 'Serveur',
                'adresse_ip' => '192.168.1.4',
                'date_acquisition' => '2024-01-08',
                'statut' => 'Actif',
                'prix' => 5200000, // 5 200 000 FCFA
            ],
            [
                'nom' => 'Serveur NAS Synology RackStation',
                'type' => 'Serveur',
                'adresse_ip' => '192.168.1.10',
                'date_acquisition' => '2023-09-05',
                'statut' => 'En maintenance',
                'prix' => 2100000, // 2 100 000 FCFA
            ],

            // Switches & Matériel Réseau
            [
                'nom' => 'Switch Cisco Catalyst 9300 - Core Network',
                'type' => 'Switch',
                'adresse_ip' => '192.168.1.250',
                'date_acquisition' => '2023-02-10',
                'statut' => 'Actif',
                'prix' => 2400000, // 2 400 000 FCFA
            ],
            [
                'nom' => 'Switch Ubiquiti UniFi Pro 48 PoE - Étage 1',
                'type' => 'Switch',
                'adresse_ip' => '192.168.1.251',
                'date_acquisition' => '2023-07-20',
                'statut' => 'Actif',
                'prix' => 850000, // 850 000 FCFA
            ],
            [
                'nom' => 'Switch Ubiquiti UniFi Pro 48 PoE - Étage 2',
                'type' => 'Switch',
                'adresse_ip' => '192.168.1.252',
                'date_acquisition' => '2023-07-22',
                'statut' => 'Actif',
                'prix' => 850000, // 850 000 FCFA
            ],
            [
                'nom' => 'Switch MikroTik CRS328 - Baie Serveurs',
                'type' => 'Switch',
                'adresse_ip' => '192.168.1.253',
                'date_acquisition' => '2023-10-11',
                'statut' => 'En maintenance',
                'prix' => 520000, // 520 000 FCFA
            ],
        ];

        foreach ($equipements as $data) {
            Equipement::updateOrCreate(
                ['adresse_ip' => $data['adresse_ip']],
                $data
            );
        }
    }
}
