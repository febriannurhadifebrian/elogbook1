<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH .'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Fitur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Checklist_model');

    }

    public function index()
    {
        $data['title'] = 'E-Logbook';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $nip = $data['user']['nip'];
        $kode = $data['user']['kode'];
    
        // Memanggil metode getLogbook() dengan argumen NIP
        // $data['logbook'] = $this->Logbook_model->getLog($kode);
        // $data['unit'] = $this->User_model->getUnitbyNip();
    
        if ($data['user']['role_id'] == 1) {
            $data['logbookuser'] = $this->Admin_model->getAllLogbooks();
        } else {
            $data['logbookuser'] = $this->Logbook_model->getLogbook($nip);
        }
    
        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('logbook/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function hapus_book($id)
    {
        $this->Logbook_model->hapus_book($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('fitur');
    }

    public function edit_book($id)
    {
        $data['title'] = 'Update E-Logbook';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['elogbook'] = $this->Logbook_model->getBookById($id);
        $data['listlayanan'] = ['layanan', 'BBS Sakti', 'Ai Bakti', 'Vsatstar', 'Remote Vsat IP', 'Mobile Vsat IP', 
        'Mangosfamily', 'Radio IP', 'MCS (Mobile Connectivity Service)', 'Maritim Gyro', 'Broadcast', 'Vsat SCPC', 
        'Vsat DSCPC', 'MPLS', 'BGAN (Broadband Global Area Network) ', 'MSP', 'FBB(Fleet Broadband)', 'SBB (Swift Broadband)', 
        'CPE', 'HT satellite', 'SN (Support Network)', 'SGN (Solution Global Network)'];

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('logbook/edit_book', $data);
            $this->load->view('templates/footer');
        }
    }

    public function changeBook()
    {
        $id = $this->input->post('id', true);

        $upload_image = $_FILES['attachment']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/lampiran/';
            $config['file_name'] = uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('attachment')) {
                $old_image = $this->Logbook_model->getBookById($id);
                if ($old_image != $upload_image) {
                    unlink(FCPATH . 'assets/lampiran/' . $old_image['lampiran']);
                }

                $new_image = $this->upload->data();
                $lampiran = $new_image['file_name'];
                // $new_image = $this->upload->data('file_name');
                $this->db->set('lampiran', $lampiran);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('fitur');
            }
        }
        $this->Logbook_model->editBook($id);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('fitur');
    }

    public function logbook($nip)
    {
        $data['title'] = 'My E-Logbook';
        $data['user'] = $this->db->get_where('tb_user', ['nip' => $nip])->row_array();

        $data['logbookuser'] = $this->Logbook_model->getBookByNip($nip);
        $data['unit'] = $this->Logbook_model->getUnitbyNip($nip);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('logbook/view_book', $data);
        $this->load->view('templates/footer');
    }

    public function add_logbook()
    {
        $data['title'] = 'Add E-Logbook Entry';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('logbook/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Check if there's a file to upload
            $upload_config['upload_path'] = './assets/lampiran/';
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $upload_config['max_size'] = '10000';
            $upload_config['file_name'] = uniqid(); // Generate a unique filename

            $this->load->library('upload', $upload_config);
            if ($this->upload->do_upload('attachment')) {
                $upload_data = $this->upload->data();
                $lampiran = $upload_data['file_name'];

                $logbook_data = [
                    'nip' => $this->input->post('nip'),
                    'tgl' => $this->input->post('tgl'),
                    'kategori' => $this->input->post('kategori'),
                    'judul' => $this->input->post('judul'),
                    'layanan' => $this->input->post('layanan'),
                    'lampiran' => $lampiran
                ];

                if (!$this->Logbook_model->addLogbook($logbook_data)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menyimpan data ke database.</div>');
                    redirect('fitur', 'refresh');
                } else {
                    // Sukses menyimpan, Anda bisa menambahkan logika lain atau pesan sukses di sini
                    $this->session->set_flashdata('flash', 'Ditambah');
                    redirect('fitur', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('fitur', 'refresh');
            }
        }
    }

    public function checklist()
    {
        $data['title'] = 'checklist';
        $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['username'] = isset($user['username']) ? $user['username'] : '';
    
        if ($user['role_id'] == 1) {
            $data['checklist'] = $this->Checklist_model->getAllChecklistData();
        } else {
            $data['checklist'] = $this->Checklist_model->getChecklistData($user['nip']);
        }
    
        $data['user'] = $user;
    
        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('checklist/index', $data);
        $this->load->view('templates/footer');
    }
    



    public function add_checklist()
    {
    $data['title'] = 'Add Checklist Entry';
    $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nip = $user['nip'];

        $dataToInsert = [
            'nip' => $nip,
            'tgl' => $this->input->post('tgl'),
            'care_center' => $this->input->post('care_center'),
            'shift' => $this->input->post('shift'),
            'hp' => $this->input->post('hp'),
            'pc' => $this->input->post('pc'),
            'monitoring' => $this->input->post('monitoring'),
            'apptools' => $this->input->post('apptools'),
            'webtools' => $this->input->post('webtools'),
            'catatan' => $this->input->post('catatan'),
        ];

        try {
            // Simpan data ke database, sesuaikan dengan model dan tabel Anda
            $this->Checklist_model->add_checklist($dataToInsert);

            // Set flashdata
            $this->session->set_flashdata('flash', 'Ditambah');

            // Redirect ke halaman lain jika perlu
            redirect('fitur/checklist', 'refresh');
        } catch (Exception $e) {
            // Penanganan kesalahan, bisa berupa pesan error atau tindakan lain sesuai kebutuhan
            $this->session->set_flashdata('flash', 'Gagal menambahkan data: ' . $e->getMessage());
            redirect('fitur/checklist', 'refresh');
        }
    }
}

    public function updateChecklist($id){
        $data['title'] = 'Update Checklist Entry';
        $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['checklist'] = $this->db->get_where('checklist', ['id' => $id, 'nip' => $user['nip']])->row_array();
        $nip = $this->input->post('nip');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataToUpdate = [
                'tgl' => $this->input->post('tgl'),
                'care_center' => $this->input->post('care_center'),
                'shift' => $this->input->post('shift'),
                'hp' => $this->input->post('hp'),
                'pc' => $this->input->post('pc'),
                'monitoring' => $this->input->post('monitoring'),
                'apptools' => $this->input->post('apptools'),
                'webtools' => $this->input->post('webtools'),
                'catatan' => $this->input->post('catatan'),
            ];

            // Memanggil fungsi update_checklist dari model Checklist_model
            $result = $this->Checklist_model->update_checklist($id, $nip, $dataToUpdate);

            if ($result) {
                $this->session->set_flashdata('flash', 'Diupdate');
            } else {
                $this->session->set_flashdata('flash', 'Gagal update data');
            }

            redirect('fitur/checklist', 'refresh');
        }
    }

    public function hapus_checklist($id)
    {
        $this->Checklist_model->hapus_checklist($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('fitur/checklist','refresh');
    }

    public function view_checklist($id)
    {
        // Mengambil data checklist berdasarkan ID
        $data['checklist_detail'] = $this->Checklist_model->getChecklistById($id);
        
        // Menampilkan view_checklist
        $this->load->view('checklist/view_checklist', $data);

    }

    // public function export_excel() {
    //     $nip = $this->session->userdata('nip');
    
    //     // Panggil model untuk mendapatkan logbook milik pengguna yang sedang login
    //     $this->load->model('Logbook_model');
    //     // $logbook_list = $this->Logbook_model->logbook_list_for_user($nip);
    
    //     try {
    //         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $sheet->setCellValue('A1', 'No.');
    //         $sheet->setCellValue('B1', 'Tanggal');
    //         $sheet->setCellValue('C1', 'Kategori');
    //         $sheet->setCellValue('D1', 'Layanan');
    //         $sheet->setCellValue('E1', 'Judul');
    
    //         $row = 2;
    //         $no = 1; 
    
    //         foreach ($logbook_list as $log) {
    //             $sheet->setCellValue('A'.$row, $no);
    //             $sheet->setCellValue('B'.$row, $log->tgl);
    //             $sheet->setCellValue('C'.$row, $log->kategori);
    //             $sheet->setCellValue('D'.$row, $log->layanan);
    //             $sheet->setCellValue('E'.$row, $log->judul);
    //             $row++;
    //             $no++;
    //         }
    
    //         // Set header dan menyimpan file Excel
    //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment;filename="logbook.xlsx"');
    //         header('Cache-Control: max-age=0');
    //         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    //         $writer->save('php://output');
    //         exit(); // Ensure script execution ends after saving
    //     } catch (Exception $e) {
    //         // Handle any exceptions here
    //         echo 'Caught exception: ',  $e->getMessage(), "\n";
    //     }
    // }
    
    public function export_excel() {
        $nip = $this->session->userdata('nip');
        $isAdmin = $this->session->userdata('role_id') == 1;
    
        // Panggil model untuk mendapatkan logbook milik pengguna yang sedang login
        $this->load->model('Logbook_model');
        $this->load->model('Admin_model');
    
        try {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            $sheet->getStyle('1:1')->getFont()->setBold(true);
    
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Kategori');
            $sheet->setCellValue('D1', 'Layanan');
            $sheet->setCellValue('E1', 'Judul');
            $sheet->setCellValue('F1', 'Lampiran');
    
            $row = 2;
            $no = 1;
    
            if ($isAdmin) {
                $logbookList = $this->Admin_model->getAllLogbooks();
            } else {
                $logbookList = $this->Logbook_model->getLogbook($nip);
            }
    
            foreach ($logbookList as $log) {
                $sheet->setCellValue('A'.$row, $no);
                $sheet->setCellValue('B'.$row, $log->tgl);
                $sheet->setCellValue('C'.$row, $log->kategori);
                $sheet->setCellValue('D'.$row, $log->layanan);
                $sheet->setCellValue('E'.$row, $log->judul);
    
                if (!empty($log->lampiran)) {
                    $imagePath = 'assets/lampiran/' . $log->lampiran;
                    if (file_exists($imagePath)) {
                        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                        $drawing->setName('Attachment');
                        $drawing->setDescription('Attachment');
                        $drawing->setPath($imagePath);
                        $drawing->setCoordinates('F' . $row);
                        $drawing->setOffsetX(5);
                        $drawing->setOffsetY(5);
                        $drawing->setWidth(100); 
                        $drawing->setHeight(100);
    
                        $sheet->getStyle('F' . $row)->getAlignment()->setWrapText(true);
    
                        foreach (range('A', 'F') as $column) {
                            $sheet->getStyle($column . $row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                        }
    
                        $imageHeight = $drawing->getHeight();
                        $sheet->getRowDimension($row)->setRowHeight($imageHeight);
    
                        $drawing->setWorksheet($sheet);
                    }
                }
    
                $row++;
                $no++;
            }
    
            foreach (range('A', 'E') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            $sheet->getColumnDimension('F')->setWidth(30);
    
            // Set header dan menyimpan file Excel
            $filename = 'logbook_' . $nip . '_' . date('YmdHis') . '.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    
            // Use php://output directly in save method
            $writer->save('php://output');
            exit(); // Ensure script execution ends after saving
        } catch (Exception $e) {
            // Handle any exceptions here
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    // public function exportChecklistExcel() {
    //     $nip = $this->session->userdata('nip');

    //     try {
    //         $checklist_data = $this->Checklist_model->getChecklistExport($nip);

    //         $spreadsheet = new Spreadsheet();
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $sheet->setCellValue('A1', 'No.');
    //         $sheet->setCellValue('B1', 'Tanggal');
    //         $sheet->setCellValue('C1', 'Shift');
    //         $sheet->setCellValue('D1', 'HP');
    //         $sheet->setCellValue('E1', 'PC');
    //         $sheet->setCellValue('F1', 'Monitoring');
    //         $sheet->setCellValue('G1', 'AppTools');
    //         $sheet->setCellValue('H1', 'WebTools');
    //         $sheet->setCellValue('I1', 'Catatan');

    //         $row = 2;
    //         $no = 1;
    //         foreach ($checklist_data as $checklist) {
    //             $sheet->setCellValue('A'.$row, $no);
    //             $sheet->setCellValue('B'.$row, $checklist->tgl);
    //             $sheet->setCellValue('C'.$row, $checklist->shift);
    //             $sheet->setCellValue('D'.$row, $checklist->hp);
    //             $sheet->setCellValue('E'.$row, $checklist->pc);
    //             $sheet->setCellValue('F'.$row, $checklist->monitoring);
    //             $sheet->setCellValue('G'.$row, $checklist->apptools);
    //             $sheet->setCellValue('H'.$row, $checklist->webtools);
    //             $sheet->setCellValue('I'.$row, $checklist->catatan);
    //             $row++;
    //             $no++;
    //         }

    //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment;filename="checklist.xlsx"');
    //         header('Cache-Control: max-age=0');

    //         $writer = new Xlsx($spreadsheet);
    //         $writer->save('php://output');
    //         exit(); // Pastikan eksekusi script berhenti setelah menyimpan
    //     } catch (Exception $e) {
    //         // Tangani exception jika terjadi
    //         echo 'Caught exception: ',  $e->getMessage(), "\n";
    //     }
    // }

    public function exportChecklistExcel() {
        $nip = $this->session->userdata('nip');
        $isAdmin = $this->session->userdata('role_id') == 1;
    
        try {
            if ($isAdmin) {
                $checklist_data = $this->Checklist_model->getAllChecklistData();
            } else {
                $checklist_data = $this->Checklist_model->getChecklistData($nip);
            }

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Shift');
            $sheet->setCellValue('D1', 'HP');
            $sheet->setCellValue('E1', 'PC');
            $sheet->setCellValue('F1', 'Monitoring');
            $sheet->setCellValue('G1', 'AppTools');
            $sheet->setCellValue('H1', 'WebTools');
            $sheet->setCellValue('I1', 'Catatan');

            $sheet->getStyle('1:1')->getFont()->setBold(true);
    
            $row = 2;
            $no = 1;
    
            foreach ($checklist_data as $checklist) {
                $sheet->setCellValue('A'.$row, $no);
                $sheet->setCellValue('B'.$row, $checklist['tgl']);
                $sheet->setCellValue('C'.$row, $checklist['shift']);
                $sheet->setCellValue('D'.$row, $checklist['hp']);
                $sheet->setCellValue('E'.$row, $checklist['pc']);
                $sheet->setCellValue('F'.$row, $checklist['monitoring']);
                $sheet->setCellValue('G'.$row, $checklist['apptools']);
                $sheet->setCellValue('H'.$row, $checklist['webtools']);
                $sheet->setCellValue('I'.$row, $checklist['catatan']);
                $row++;
                $no++;
            }

            foreach (range('A', 'I') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
    
            $filename = 'checklist_' . $nip . '_' . date('YmdHis') . '.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
    
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit(); // Pastikan eksekusi script berhenti setelah menyimpan
        } catch (Exception $e) {
            // Tangani exception jika terjadi
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
}
