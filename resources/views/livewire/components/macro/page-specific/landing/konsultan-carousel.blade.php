<?php

use Livewire\Volt\Component;

new class extends Component {
    /**
     * this component requires OwlCarousel
     * */
    public $konsultan;
    public $navigation = '';
    public $items = '';
    public $owl_konsultan_carousel = ''; #model
    public function mount()
    {
        $this->konsultan = [
            (object) [
                'name' => 'Kak Wahyu',
                'title' => 'Bidang SDM',
                'filename' => $this->konsultanPath('Wahyu Tri.jpg'),
                'telp' => '85643073458',
                'email' => 'wahyu.plutjogja@gmail.com',
                'sertifikasi' => ['Manajer Pengelola Lembaga Pendamping UMKM', 'Instruktur Penyelia (Level 4)', 'Konsultan Perkoperasian', 'Pelaksana Ekspor', 'Pendamping UMKM', 'Kewirausahaan Industri', 'Digital Marketing', 'Customer Service'],
            ],
            (object) [
                'name' => 'Kak Anto',
                'title' => 'Kerjasama dan Inkubasi Bisnis',
                'filename' => $this->konsultanPath('Anto Budi.jpg'),
                'telp' => '85786548676',
                'email' => 'antobudinugroho29@gmail.com',
                'sertifikasi' => ['Konsultan Perkoperasian', 'Digital Marketing', 'Kewirausahaan Industri', 'Customer Service', 'Pendamping UMKM', 'Instruktur Penyelia (level 4)'],
            ],
            (object) [
                'name' => 'Kak Fitri',
                'title' => 'Bidang Kelembagaan',
                'filename' => $this->konsultanPath('Fitria Agustin.jpg'),
                'telp' => '81578058374',
                'email' => 'fasadhila@gmail.com',
                'sertifikasi' => ['WPA/ Workplace Asessment (Sertifikasi Asesor)', 'Training Pelatihan KKNI Level 3', 'Instruktur Penyelia (Level 4)', 'Konsultan Perkoperasian', 'Pelaksana Ekspor', 'Pendamping UMKM', 'Kewirausahaan Industri', 'Digital Marketing', 'Customer Service', 'Sertifikasi Kompetensi Metodologi Instruktur', 'Sertifikasi Perawatan Badan', 'Sertifikasi Perawatan Wajah', 'Sertifikasi Kompetensi Pelayanan Pelanggan'],
            ],
            (object) [
                'name' => 'Kak Rantika',
                'title' => 'bidang teknologi informasi',
                'filename' => $this->konsultanPath('lista Rantika.jpg'),
                'telp' => '82137138039',
                'email' => 'lista.plutjogja@gmail.com',
                'sertifikasi' => ['Pelaksana Ekspor', 'Konsultan Perkoperasian', 'Digital Marketing', 'Kewirausahaan Industri', 'Customer Service', 'Pendamping UMKM', 'Manajer Pengelola Lembaga Pendamping UKM', 'Instruktur Penyelia (level 4)'],
            ],
            (object) [
                'name' => 'Kak Masreza',
                'title' => 'Produktifitas, Sertifikasi dan Standarisasi Produk',
                'filename' => $this->konsultanPath('Masreza Parahadi.jpg'),
                'telp' => '85729278304',
                'email' => 'masrezaparahadi@gmail.com',
                'sertifikasi' => ['Digital Marketing', 'Kemanan Pangan/ CPPOB', 'fasilitator dan pelatihan UMKM', 'Kewirausahaan Industri'],
            ],
            (object) [
                'name' => 'Kak Romli',
                'title' => 'Pendampingan Usaha dan Pendataan KUKM',
                'filename' => $this->konsultanPath('Romli Nur Hidayat.jpg'),
                'telp' => '082137652772',
                'email' => null,
                'sertifikasi' => ['Instruktur Penyelia', 'Pendamping UMKM', 'Konsultan Peroperasian', 'Pendamping Perkoperasian', 'Digital Marketing', 'Customer Service'],
            ],
            (object) [
                'name' => 'Kak Rosyid',
                'title' => 'Bidang Pemasaran',
                'filename' => $this->konsultanPath('Rosyid Kusuma.jpg'),
                'telp' => '87700211660',
                'email' => 'rosyid.plutjogja@gmail.com',
                'sertifikasi' => ['Manajer Pengelola Lembaga Pendamping UMKM', 'Instruktur Penyelia (Level 4)', 'Konsultan Perkoperasian', 'Pelaksana Ekspor', 'Pendamping UMKM', 'Kewirausahaan Industri', 'Digital Marketing', 'Customer Service', 'Pendamping Halal', 'Kursus Pembina Pramuka Mahir Tingkat Dasar (KMD)'],
            ],
        ];
    }
    public function konsultanPath($filename)
    {
        return asset("core/images/konsultan/{$filename}");
    }
}; ?>

<div class=""></div>
