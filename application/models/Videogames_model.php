<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Videogames_model extends CI_Model {

        function getVideogames($search, $rowno){
            $this->db->select('*');
            $this->db->from('videogames');
            $this->db->like('LOWER(name)', strtolower($search));
            $this->db->or_like('LOWER(publisher)', strtolower($search));
            $this->db->or_like('LOWER(nickname)', strtolower($search));
            $this->db->or_like('LOWER(rating)', strtolower($search));
            $this->db->order_by('id');
            $this->db->limit($this->config->item('rowperpage'), $rowno);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        public function getTotal($search) {
            $this->db->select('*');
            $this->db->from('videogames');
            $this->db->like('LOWER(name)', strtolower($search));
            $this->db->or_like('LOWER(publisher)', strtolower($search));
            $this->db->or_like('LOWER(nickname)', strtolower($search));
            $this->db->or_like('LOWER(rating)', strtolower($search));
            $num = $this->db->count_all_results();
            return $num;
        }

        public function isInDatabase($data){
            $this->db->select('*');
            $this->db->from('videogames');
            $this->db->where('name', $data['name']);
            $this->db->where('publisher', $data['publisher']);
            $query = $this->db->get();
            if ( $query->num_rows() > 0 ){
                return true;
            }else{
                return false;
            }
        }

        public function setVideogame($data){
            if($this->isInDatabase($data)){
                $result["query"] = false;
            }else{
                $result["query"] = $this->db->insert('videogames', $data);
            }
            $result["result"] = $this->db->error();
            return $result;
        }
    }
?>