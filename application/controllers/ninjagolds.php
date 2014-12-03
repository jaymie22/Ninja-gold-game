<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ninjagolds extends CI_Controller {

	public function index()
	{
		$this->load->view('ninja_golds');
	}

	public function process_money()
	{
		if ($this->input->post('building') == 'farm')
			$this->gold(10, 20, 'farm');
		elseif ($this->input->post('building') == 'cave') 
			$this->gold(5, 10, 'cave');
		elseif ($this->input->post('building') == 'house') 
			$this->gold(2, 5, 'house');
		elseif ($this->input->post('building') == 'casino') 
			$this->gold(0, 50, 'casino');

		$activities_log['activity_log'] = explode(",", $this->session->userdata('activities_log'));

		$this->load->view('ninja_golds',$activities_log);
	}

	public function gold($min_gold, $max_gold, $building)
	{
		$random_gold = rand($min_gold,$max_gold);
		$date = date('F j  Y h:i A');
		
		$gold = $this->session->userdata('gold_value');

		if($building ==  'casino')
		{
			$chances = rand(1,100);
			$activity_status = "earn";
			if($chances >= 1 && $chances <= 70)
			{
				($gold === FALSE) ? $gold = $random_gold : $gold += $random_gold;
				$activity = "Earned " . $random_gold . " golds from the " . $building . "! (" . $date . ")";
			}
			else
			{
				($gold === FALSE) ? $gold = 0 - $random_gold : $gold -= $random_gold;
				$activity = "Entered a " . $building . " and lost " . $random_gold . " golds... Ouch ..." . "(" . $date . ")";
				$activity_status = "lost";
			}
		}
		else
		{
			($gold === FALSE) ? $gold = $random_gold : $gold += $random_gold;
			$activity = "Earned " . $random_gold . " golds from the " . $building . "! (" . $date . ")";
		}

		$this->session->set_userdata('gold_value', $gold);

		$activities = $this->session->userdata('activities_log');
		$activities = ($activities === FALSE) ? $activity : $activities . "," . $activity;
		$this->session->set_userdata('activities_log', $activities);	
	}

	public function reset_game()
	{
		$this->session->unset_userdata('gold_value');
		$this->session->unset_userdata('activities_log');
		$this->load->view('ninja_golds');
	}

}

/* End of file ninjagolds.php */
/* Location: ./application/controllers/ninjagolds.php */