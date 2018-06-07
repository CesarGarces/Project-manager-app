<?php

class Panel{

	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;

	public function __construct(){

		$this->objDb = new Database();
		$this->objSe = new Sessions();

	}



	
    public function total_monitoreo($ini,$fin){


        $query = "SELECT count(id_enc_monitoreo) as tot_monitoreo FROM enc_monitoreo where fecha_encuesta BETWEEN '".$ini."' AND '".$fin."' ";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    public function tmo($ini,$fin){


        $query = "SELECT time_format(sec_to_time(avg(time_to_sec(anexo_enc9))),'%H:%i:%s') as total_tmo  FROM enc_monitoreo where fecha_encuesta BETWEEN '".$ini."' AND '".$fin."' ";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    public function tme($ini,$fin){


        $query = "SELECT time_format(sec_to_time(avg(time_to_sec(anexo_enc10))),'%H:%i:%s') as total_tme  FROM enc_monitoreo where fecha_encuesta BETWEEN '".$ini."' AND '".$fin."' ";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    
    public function total_0_6_renovacion($ini,$fin){


        $query = "SELECT count(preg8) as tot_0_6 FROM enc_renovacion where fecha_crea BETWEEN '".$ini."' AND '".$fin."' and enc_renovacion.preg8 >= 0 and enc_renovacion.preg8 <= 6";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    
    public function total_7_8_renovacion($ini,$fin){


        $query = "SELECT count(preg8) as tot_7_8 FROM enc_renovacion where fecha_crea BETWEEN '".$ini."' AND '".$fin."' and enc_renovacion.preg8 >= 7 and enc_renovacion.preg8 <= 8";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    public function total_mes_renovacion($ini,$fin){


        $query = "SELECT count(preg8) as totMes FROM enc_renovacion where fecha_crea BETWEEN '".$ini."' AND '".$fin."' ";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    ////////////////ventas/////////////////////////
    public function total_9_10_ventas($ini,$fin){


        $query = "SELECT count(preg6) as tot_9_10 FROM enc_ventas where fecha_crea BETWEEN '".$ini."' AND '".$fin."' and enc_ventas.preg6 >= 9 and enc_ventas.preg6 <= 10";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    
    public function total_0_6_ventas($ini,$fin){


        $query = "SELECT count(preg6) as tot_0_6 FROM enc_ventas where fecha_crea BETWEEN '".$ini."' AND '".$fin."' and enc_ventas.preg6 >= 0 and enc_ventas.preg6 <= 6";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    
    public function total_7_8_ventas($ini,$fin){


        $query = "SELECT count(preg6) as tot_7_8 FROM enc_ventas where fecha_crea BETWEEN '".$ini."' AND '".$fin."' and enc_ventas.preg6 >= 7 and enc_ventas.preg6 <= 8";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    public function total_mes_ventas($ini,$fin){


        $query = "SELECT count(preg6) as totMes FROM enc_ventas where fecha_crea BETWEEN '".$ini."' AND '".$fin."' ";
        $this->result = $this->objDb->select($query);
        return $this->result;

    }
    
	
}

?>
