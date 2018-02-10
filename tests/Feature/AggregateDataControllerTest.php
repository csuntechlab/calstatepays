<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\AggregateDataController;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
class AggregateDataControllerTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp(){
        parent::setUp();
        $this->aggregateDataController = new AggregateDataController;
    }

    public function testGetAverageIncomeByStudentPath()
    {
        $entry_status = 'FTF';
        $years = 2;
        $id = 1;
        $university_majors_id = 1;
        $averages=['1'=>[],'2'=>[],'3'=>[]];
        for($i=1;$i<=3;$i++){
            for($j=1;$j<=3;$j++){
                $student_path = $i;
                $major_path_id = $id++;
                $avg_annual_wage = random_int(30000,60000);
                array_push($averages[$i],$avg_annual_wage);
                MajorPath::create(
                    [
                        'id' => $major_path_id,
                        'student_path' => $student_path,
                        'university_majors_id' => $university_majors_id++,
                        'entry_status' => $entry_status,
                        'years' => $years

                    ]
                );
                MajorPathWage::create(
                    [
                        'major_path_id' => $major_path_id,
                        'avg_annual_wage' => $avg_annual_wage,
                        '25th' => random_int(30000,40000),
                        '50th' => random_int(40000,50000),
                        '75th' => random_int(50000,60000),
                        'population_sample_id' => random_int(1,9999)
                    ]
                );
            }
        }
        foreach ($averages as $average_number => $average){
            $averages[$average_number] = array_sum($averages[$average_number])/count($averages[$average_number]);
        }
        $data = $this->aggregateDataController->getAverageIncomeByStudentPath();

        $this->assertEquals($averages['1'],$data['some_college_avg']);
        $this->assertEquals($averages['2'],$data['bachelors_avg']);
        $this->assertEquals($averages['3'],$data['masters_avg']);

    }
}