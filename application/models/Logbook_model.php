<?php

class Logbook_model extends CI_Model
{
    public function addLogbook($data)
    {
        $data = [
            "nip" => $this->input->post('nip', true),
            "tgl" => $this->input->post('tgl', true),
            "kategori" => $this->input->post('kategori', true),
            "layanan" => $this->input->post('layanan', true),
            "judul" => $this->input->post('judul', true),
            "lampiran" => $data['lampiran'] // Simpan nama file lampiran ke dalam database
        ];
        return $this->db->insert('tb_logbook', $data);
    }


    public function hapus_book($id)
    {
        $this->db->delete('tb_logbook', ['id' => $id]);
    }

    public function getLogbook($user_id)
    {
        $this->db->select('tb_logbook.*, tb_user.username');
        $this->db->from('tb_logbook');
        $this->db->join('tb_user', 'tb_user.nip = tb_logbook.nip');

        if ($user_id != 1) {
            $this->db->where('tb_logbook.nip', $user_id);
        }

        return $this->db->get()->result();
    }

    public function getLogbookByUser($user_id)
    {
        $this->db->select('tb_logbook.*, tb_user.username');
        $this->db->from('tb_logbook');
        $this->db->join('tb_user', 'tb_user.nip = tb_logbook.nip');
        $this->db->where('tb_logbook.nip', $user_id);

        return $this->db->get()->result();
    }


    public function getLog($user_kode)
    {
        return $this->db->get_where('tb_logbook', ['kode' => $user_kode])->result_array();
    }

    public function getBookById($id)
    {
        return $this->db->get_where('tb_logbook', ['id' => $id])->row_array();
    }

    public function editBook($id)
    {
        $data = [
            "tgl" => $this->input->post('tgl', true),
            "kategori" => $this->input->post('kategori', true),
            "lokasi" => $this->input->post('lokasi', true),
            "layanan" => $this->input->post('layanan', true),
            "judul" => $this->input->post('judul', true),
            "ket" => $this->input->post('ket', true),
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_logbook', $data);
    }

    public function getBookByNip($nip)
    {
        $this->db->select('*');
        $this->db->from('tb_logbook');
        $this->db->where('tb_logbook.nip', $nip);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUnitbyNip($nip)
    {
        $this->db->select('tb_user.kode,tb_unit.kode AS kode, tb_unit.unit');
        $this->db->from('tb_user', 'tb_unit');
        $this->db->join('tb_unit', 'tb_unit.kode=tb_user.kode');
        $this->db->where('tb_user.nip', $nip);
        $query = $this->db->get();
        return $query->result();
    }

    public function getLogbookTables()
    {
    // Ambil semua NIP unik dari tabel tb_logbook
    $unique_nips = $this->db->select('nip')->get('tb_logbook')->result_array();

    $logbook_tables = [];
    foreach ($unique_nips as $nip_data) {
        $nip = $nip_data['nip'];

        // Ambil nama dari tabel tb_user berdasarkan NIP
        $user = $this->db->where('nip', $nip)->get('tb_user')->row_array();

        if ($user) {
            // Ambil data logbook berdasarkan NIP
            $logbook = $this->db->where('nip', $nip)->get('tb_logbook')->result_array();

            // Simpan data logbook per tabel dengan nama yang sesuai (misalnya, 'Logbook - Nama User')
            $table_name = 'Logbook - ' . $user['name'];
            $logbook_tables[$table_name] = $logbook;
        }
    }

    return $logbook_tables;
    }

    public function changeStatus($logbook_id)
    {
        // Mengambil data status yang dikirim melalui HTTP POST
        $new_status = $this->input->post('status', true);

        // Memastikan data status yang dikirim adalah valid

        if ($new_status === 'Open' || $new_status === 'Waiting Close') {
            // Menyiapkan data yang akan diupdate
            $data = [
                'status' => $new_status,
            ];

            // Melakukan pembaruan (update) status logbook berdasarkan ID
            $this->db->where('id', $logbook_id);
            $this->db->update('tb_logbook', $data);

            // Redirect ke halaman atau tampilkan pesan sukses
            redirect('admin/datauser'); // Ganti 'datauser' dengan URL tujuan yang sesuai
        } else {
            // Status yang dikirim tidak valid, tampilkan pesan kesalahan atau sesuaikan dengan kebutuhan Anda
            echo "Status tidak valid.";
        }
    }

    public function logbook_list_for_user($nip){
        $this->db->select("*");
        $this->db->from("tb_logbook");
        $this->db->where("nip", $nip); // Sesuaikan dengan kolom yang sesuai pada tabel logbook
        $query = $this->db->get();
        return $query->result();
    }
       
    public function countLogbook($nip) {
        $this->db->where('nip', $nip);
        return $this->db->count_all_results('logbook'); // Ganti 'logbook' dengan nama tabel logbook Anda
    }

    // Fungsi untuk mengambil data logbook dengan pagination
    public function getLogbookByPage($nip, $limit, $start) {
        $this->db->where('nip', $nip);
        $this->db->limit($limit, $start);
        $query = $this->db->get('logbook'); // Ganti 'logbook' dengan nama tabel logbook Anda

        return $query->result();
    }
   
    public function getAllLogbooks(){
            $query = $this->db->get('tb_logbook'); 
            return $query->result_array();
    }

    public function countAllLogbook($search = null){
        if ($search) {
            $this->db->like('created_by', $search);
        }
        return $this->db->get('tb_logbook')->num_rows();
    }
    public function getAllLogbook($limit, $start, $search = null, $sortCategory = null, $sortService = null){
        $this->db->where('tb_logbook.close', '');
        if (!empty($sortCategory)) {
            $this->db->where('tb_logbook.kategori', $sortCategory); // Specify the table for kategori
        }

        // Filter berdasarkan layanan
        if (!empty($sortService)) {
            $this->db->where('tb_logbook.layanan', $sortService); // Specify the table for layanan
        }

        if ($search) {
            // Search by name, nip, or other relevant columns, specifying the tables
            $this->db->group_start();
            $this->db->like('tb_user.name', $search); // Specify the table for name
            $this->db->or_like('tb_user.nip', $search); // Specify the table for nip
            // Add more columns as needed, specifying the tables
            $this->db->group_end();
        }
        $this->db->select('tb_logbook.*, tb_user.name');
        $this->db->from('tb_logbook');
        $this->db->join('tb_user', 'tb_user.nip = tb_logbook.nip');
        $this->db->limit($limit, $start); // Menambahkan limit dan offset sesuai dengan halaman yang sedang dilihat

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getClosedLogbooks($limit, $start, $search = null, $sortCategory = null, $sortService = null, $start_date = '', $end_date = ''){
        $this->db->where('tb_logbook.close', 'Y'); // Add this line to filter by the close column
        
        if (!empty($sortCategory)) {
            $this->db->where('tb_logbook.kategori', $sortCategory); // Specify the table for kategori
        }
        
        if (!empty($sortService)) {
            $this->db->where('tb_logbook.layanan', $sortService); // Specify the table for layanan
        }

        if ($search) {
            $this->db->group_start();
            $this->db->like('tb_user.name', $search); // Specify the table for name
            $this->db->or_like('tb_user.nip', $search); // Specify the table for nip
            // Add more columns as needed, specifying the tables
            $this->db->group_end();
        }

        //filter tanggal
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tb_logbook.tgl >=', $start_date);
            $this->db->where('tb_logbook.tgl <=', $end_date);
        }

        $this->db->select('tb_logbook.*, tb_user.name');
        $this->db->from('tb_logbook');
        $this->db->join('tb_user', 'tb_user.nip = tb_logbook.nip');
        $this->db->limit($limit, $start); // Menambahkan limit dan offset sesuai dengan halaman yang sedang dilihat

        $query = $this->db->get();
        return $query->result_array();
    }


    public function moveLogbook($logbookId){
        $this->db->where('id', $logbookId);
        $this->db->update('tb_logbook', array('close' => 'Y'));

        return true; 
    }
}
