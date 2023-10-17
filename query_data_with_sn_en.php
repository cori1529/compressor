<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />  <!-- 콘텐츠 유형은 HTML 형식의 문서임  -->

	<style type="text/css">
            .scrolltbody {
               display: block; /* block 레벨요소는 다른 요소위에 쌓이면 , 기본적으로 가로전체너비 차지*/
               width: 2900px;
               border-collapse: collapse;
            }
            .scrolltbody th { border: 1px solid #000; background: #3c9ad5; height: 20px; font-size: 12px; text-align: center; color: white}/* 머리글에 대한 */
            .scrolltbody td { border: 1px solid #000; border-top: 0; height: 20px; font-size: 14px }
            .scrolltbody tbody {
                display: block; /* 새로운 줄에서 시작하고, 가로공간 전테차치 */
               height: 780px; 
               overflow: auto; /*  요소내용이 설정한 높이를 초과할 경우 , auto 값은 내용이 넘칠때 스크롤바를 표시*/
            }
            .scrolltbody th:nth-of-type(1), .scrolltbody td:nth-of-type(1) { width: 60px; text-align: center; }  /* 번호 */
            .scrolltbody th:nth-of-type(2), .scrolltbody td:nth-of-type(2) { width: 110px; text-align: center; } /*환전요청일 */
            .scrolltbody th:nth-of-type(3), .scrolltbody td:nth-of-type(3) { width: 80px; text-align: center; } /*환전요청시간 */
            .scrolltbody th:nth-of-type(4), .scrolltbody td:nth-of-type(4) { width: 45px; text-align: center; } /*환전요청요일 */
            .scrolltbody th:nth-of-type(5), .scrolltbody td:nth-of-type(5) { width: 50px; text-align: center; } /*포트 */
            .scrolltbody th:nth-of-type(6), .scrolltbody td:nth-of-type(6) { width: 120px; text-align: center; }/*사용자전화번호 */  
            .scrolltbody th:nth-of-type(7), .scrolltbody td:nth-of-type(7) { width: 150px; text-align: center; } /*  사용자 이름*/
            .scrolltbody th:nth-of-type(8), .scrolltbody td:nth-of-type(8) { width: 100px; text-align: center; }  /* 은행*/
            .scrolltbody th:nth-of-type(9), .scrolltbody td:nth-of-type(9) { width: 250px; text-align: center; }  /* 은행계좌번호*/
            .scrolltbody th:nth-of-type(10), .scrolltbody td:nth-of-type(10) { width: 120px; text-align: center; } /* 환전요청포인트 */
            .scrolltbody th:nth-of-type(11), .scrolltbody td:nth-of-type(11) { width: 120px; text-align: center; } /* 환전요청상태저리 */
            .scrolltbody th:nth-of-type(12), .scrolltbody td:nth-of-type(12) { width: 70px; text-align: center; } /* reserved1 */
            .scrolltbody th:nth-of-type(13), .scrolltbody td:nth-of-type(13) { width: 70px; text-align: center; } /*reserved2 */
            .scrolltbody th:nth-of-type(14), .scrolltbody td:nth-of-type(14) { width: 70px; text-align: center; } /*reserved3 */
            .scrolltbody th:nth-of-type(15), .scrolltbody td:nth-of-type(15) { width: 70px; text-align: center; } /*reserved4 */
            .scrolltbody th:nth-of-type(16), .scrolltbody td:nth-of-type(16) { width: 70px; text-align: center; } /*reserved5 */
           
		thead tr th {
			width: 100px;
            font-family: "굴림";
            font-size:20px;
            font-weight:bold;
            text-align:center;
            padding-left:1;
            padding-right:1;
            height:20px;
            border-bottom:1px solid #bbbbbb; border-left:1px solid #bbbbbb; background-color: #eeece1;
		}
		tbody tr td {
			width: 100px;
            font-family: "굴림";
            font-size:14px;
            text-align:center;
            padding-left:1;
            padding-right:1;
            height:20px;
            border-bottom:1px solid #bbbbbb; border-left:1px solid #bbbbbb;
		}

		.tbl_new {
		border-top:1px solid #bbbbbb;
            display: block;
            width: 1860px;
            border-collapse: collapse;
		}
		.row_even {
			background-color: #eeece1;
		}
		.row_even_last {
			text-align:right;
			border-right:1px solid #bbbbbb;
			background-color: #eeece1;
		}
		.border_last{
            text-align:right;
            border-right:1px solid #bbbbbb;
		}
		.border_none{
            text-align:left;
            border-bottom:1px solid #ffffff; border-left:1px solid #ffffff;
		}

	</style>
</head>

<?php
//    error_reporting(E_ALL);
?>

<BODY>
    <?php //장비상태정보
        // 2020.4.2 - dtb, dte 를 2020/3/1 => 2020-03-01 로 변환 - 입력오류 방지

        $sn = strtoupper(trim($_POST['sn'])); // php 의 슈퍼 글로벌 변수 "$_POST"를 사용하여,  POST 요청으로 전달된 데이터 중에 'sn" 파라미터를 가져온
                                              // sn 파라미터는 웹어플리케이셔 form 에서 사용자가 입력한 데이터중에 하나
                                              // trim: sn 파라미터에서 가져온 데이터의 좌우 공백 제거
                                              // strtoupper : 대문자로 바꾸어 주고 최종적으로 '$sn" 변수에 저장한다.
        $dtb = str_replace("/", "-", trim($_POST['dtb']));
        $dte = str_replace("/", "-", trim($_POST['dte']));

        // 2020/01/02
        if($dtb[6] == '-') {
            for($i=strlen($dtb); $i>=6; $i--) $dtb[$i] = $dtb[$i-1];
            $dtb[$i] = '0';
        }
        if(strlen($dtb) == 9) {
            $dtb[9] = $dtb[8];
            $dtb[8] = '0';
        }
        // 2020/01/02
        if($dte[6] == '-') {
            for($i=strlen($dte); $i>=6; $i--) $dte[$i] = $dte[$i-1];
            $dte[$i] = '0';
        }
        if(strlen($dte) == 9) {
            $dte[9] = $dte[8];
            $dte[8] = '0';
        }

        $num = trim($_POST['num']);  
        if( $num == "") $num = "100";
        $user = substr($sn, 0, 1);
//        echo "$user, $dtb, $dte, $sn, $num";

        require_once '../../db1400_117_DB5.php';

        $db = new DBC;
        $db->DBI();
        $new_date=date("Y-m-d");
        $yesterday = date("Y/m/d",strtotime("-1 day"));

        if($dtb == "") $dtb = $new_date;
        if($dte == "") $dte = $new_date;
/*        if($sn == "") { echo "시리얼 번호를 입력하세요 ~~!"; exit; }
*/
        if($sn == "") { echo "Please Input serial no ~~!"; exit; }

        {
            //$db->query = "SELECT * FROM raw WHERE (serialno LIKE 'M%%') AND (date LIKE '$new_date') ORDER BY date DESC, time DESC";
            //$db->query = "SELECT * FROM raw WHERE (serialno LIKE 'M%%') AND (date >= '2017-12-19') ORDER BY date DESC, time DESC LIMIT 12000";
            //$db->query = "SELECT * FROM raw_10days WHERE (serialno='$sn') AND (date >= '$dtb') AND (date <= '$dte') ORDER BY date DESC, time DESC LIMIT $num";
					   //	$db->query = "SELECT * FROM raw WHERE (serialno='$sn') AND (date >= '$dtb') AND (date <= '$dte') ORDER BY date DESC, time DESC LIMIT $num";
                       // $db->query = "SELECT * FROM pay_info WHERE (paid='$sn') AND (indate >= '$dtb') AND (indate <= '$dte') ORDER BY date DESC, time DESC LIMIT $num";
                        $db->query = "SELECT * FROM pay_info WHERE (paid='$sn')";
        }

        $db->DBQ();
        $num = $db->result->num_rows;

        $d_0 = Date('n/j');
        $d_1 = Date('n/j',strtotime('-1 day'));

        echo "<H1>GRC700(무인회수기)환전요청상황</H1>";
        echo "<div class='wrap_baichul'>";
        echo 	"<wrap_baichul>";
        echo 		"<table class='scrolltbody'>";
        echo 			"<thead>";  // 머리글행
        echo 				"<tr>"; // table row  -> 새로운 행을 시작
        echo 				      "<th>번호</th>"
                                . "<th>환전요청일</th>"
                                . "<th>환전요청시간</th>"
                                . "<th>요일</th>"
                                . "<th>포트</th>"
                                . "<th>사용자전화번호</th>"
                                //. "<th style=width: 150px;>사용자전화번호</th>";
                                . "<th>사용자이름</th>"
                                . "<th>사용자은행</th>"
                                . "<th>은행계좌번호</th>"
                                . "<th>환전요청포인트</th>"
                                . "<th>환전요청상태처리</th>"
                                . "<th>reserved1</th>"
                                . "<th>reserved2</th>"
                                . "<th>reserved3</th>"
                                . "<th>reserved4</th>"
                                . "<th>reserved5</th>";
                              
        echo 				"</tr>";  // 새로운 행의 끝
        echo 			"</thead>"; // 머릿글행 끝
       
        echo "<tbody>"; // table 의 본문시작
        $no = 0;
       // for($jz=1; $jz<=16; $jz++) $date[$jz] = ""; // 2020.6.5 29 TO 50
        while($data = $db->result->fetch_row())
        {
            $no++;
            echo    "<tr>";  // 새로운 행을 시작
            if( !($no%2))  // 홀수이면
            {
                echo    "<td class='row_even'>$no</td>"; // table date -> 실제로 표시되는 셀내용
                for($iz=1; $iz<=14; $iz++)  // 2020.5.20  27 TO 41
                {
                    echo "<td class='row_even'>$data[$iz]</td>";
                }
                echo     "<td class='row_even_last'>$data[$iz]</td>";
            }
            else // 짝수이면
            {
                echo     "<td>$no</td>";
                for($iz=1; $iz<=14; $iz++) // 2020.5.20  27 TO 41
                {
                    echo "<td>$data[$iz]</td>";
                }
                echo 	 "<td class='border_last'>$data[$iz]</td>";
            }
            echo    "</tr>"; // 새로운행의 끝

           // for($jz=1; $jz<=16; $jz++) $date[$jz] = "";   // 2020.6.5 29 TO 50
        }  // while 
        echo 	"</tbody>";
        echo 	"</table>";
        echo "</div>";

    	$db->DBO();
	?>
</BODY>
</html>
