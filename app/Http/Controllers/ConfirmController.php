<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OrderList;
use App\OrderProduct;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConfirmController extends Controller
{

    function get(Request $request) {
        if(strpos($_SERVER['HTTP_USER_AGENT'], "Line") !== false)
        {
            $order_id = $request->input('order_id');

            $order = OrderList::get_order_date($order_id);
            if(!$order) {
              return redirect()->to('https://www.chapayom.com/');
            }

            $pay_option = OrderList::get_order_pay_option($order_id);
            $cost = OrderList::get_order_cost($order_id);

            $order_detail = explode(' ' , $order['created_at']);
                $order_time = date("G:i", strtotime($order_detail[1]));

            return view('thank')->with('order_id', $order_id)->with('order_date', $order_detail[0])->with('order_time', $order_time)->with('pay_option', $pay_option['pay_option'])->with('cost', $cost['order_price']);
        }
        else {
            return redirect()->to('https://www.chapayom.com/');
        }
    }

    function post(Request $request) {

        $sheet_payoption = "-";
        $order_id = $request->input('order_id');
        $comment = $request->input('order_comment');
        $pay_option = $request->input('order_payoption');

        $product_list = [];
        $product = json_decode($request->input('order_list'), true);

        if(!$comment) {
            $comment = "-";
        }
        if($pay_option == "promtpay") {
            $sheet_payoption = "QR";
        }
        else if($pay_option == "bank") {
            $sheet_payoption = "BANK";
        }
        else if($pay_option == "destination") {
            $sheet_payoption = "COD";
        }

        $total_price = 0;
        $i = 0;
        foreach($product as $p){
          $product_list[$i] = array($p['item_name'], $p['total_price'], $p['total_order']);
          $i++;
          $total_price = $total_price + $p['total_price'];
        }

        $list_name_product = array(
            "ชาแดง",
            "ชาเขียว",
            "โกโก้",
            "ชาชัก",
            "โอเลี้ยง",
            "ชาไต้หวัน",
            "ชากุหลาบ",
            "ชาเขียวมัทฉะ",
            "แก้วลายปกติ/ลัง",
            "แก้วแคปซูล/ลัง",
            "แก้วกุหลาบ/ลัง",
            "แก้วถัง/ลัง",
            "แก้วถัง/แถว",
            "แก้วยีราฟ/ลัง",
            "แก้วลายไต้หวัน/ลัง",
            "แก้วลายไต้หวัน/แถว",
            "แก้วตวงชา",
            "แก้วชงชา",
            "แก้วเชค",
            "ที่ชงชากุหลาบ",
            "แก้วตวงนม",
            "ผ้ากันเปื้อน",
            "ที่ปิดโซดา",
            "ที่ตีฟองนม");

        $product_value[24] = [];
        for($b = 0; $b < count($product_value); $b++)
        {
            $product_value[$b] = 0;
        }

        for($x = 0; $x < count($product_list); $x++)
        {
          $order_product[] =
          [
              'order_id'=> $order_id,
              'product_name' => $product_list[$x][0],
              'order_amount' => $product_list[$x][2],
              'total_price' => $product_list[$x][1]
          ];

            for($z = 0; $z < count($list_name_product); $z++) {
                if ($product_list[$x][0] == $list_name_product[$z]) {
                    $product_value[$z] = $product_list[$x][2];
                    settype($product_value[$z], "integer");
                }
            }
        }

        $user = User::get_users_data(Auth::user()->line_id);

        $append = [
            $order_id,
            now()->toDateTimeString(),
            $user['name'],
            $user['branch'],
            $product_value[0],
            $product_value[1],
            $product_value[2],
            $product_value[3],
            $product_value[4],
            $product_value[5],
            $product_value[6],
            $product_value[7],
            $product_value[8],
            $product_value[9],
            $product_value[10],
            $product_value[11],
            $product_value[12],
            $product_value[13],
            $product_value[14],
            $product_value[15],
            $product_value[16],
            $product_value[17],
            $product_value[18],
            $product_value[19],
            $product_value[20],
            $product_value[21],
            $product_value[22],
            $product_value[23],
            $total_price,
            $user['phone_number'],
            $sheet_payoption,
            $comment,
        ];

        if($user->agent_code == '3525bkk') {
            Sheets::spreadsheet('1VdS2QlTqRL9vfba1HncnH124QQ7TtWbnIFLhU0OPoRQ')
                ->sheet('Chapayom-OrderList1')
                ->append([$append]);
        } else if ($user->agent_code == '353535'){
            Sheets::spreadsheet('1VdS2QlTqRL9vfba1HncnH124QQ7TtWbnIFLhU0OPoRQ')
                ->sheet('Chapayom-OrderList2')
                ->append([$append]);
        }

        OrderProduct::insert($order_product);

        OrderList::add_order($order_id, $user['name'], $user['branch'], $user['phone_number'], $comment, $total_price, $pay_option);

        return url('/confirm');
    }

    function spreadsheetById(Request $request)
    {
        $product_value[24] = [];
        $product_list = [];
        $orderId = $request->order_id;
        $order_detail = OrderList::select('*')->where('order_id', $orderId)->first();
        $order_product_detail = OrderProduct::select('*')->where('order_id', $order_detail->order_id)->get();

        $i = 0;
        foreach($order_product_detail as $p){
            $product_list[$i] = array($p->product_name, $p->total_price, $p->order_amount);
            $i++;
        }

        $list_name_product = array(
            "ชาแดง",
            "ชาเขียว",
            "โกโก้",
            "ชาชัก",
            "โอเลี้ยง",
            "ชาไต้หวัน",
            "ชากุหลาบ",
            "ชาเขียวมัทฉะ",
            "แก้วลายปกติ/ลัง",
            "แก้วแคปซูล/ลัง",
            "แก้วกุหลาบ/ลัง",
            "แก้วถัง/ลัง",
            "แก้วถัง/แถว",
            "แก้วร้อน/แถว 50 ใบ",
            "แก้วลายไต้หวัน/ลัง",
            "แก้วลายไต้หวัน/แถว",
            "แก้วตวงชา",
            "แก้วชงชา",
            "แก้วเชค",
            "ที่ชงชากุหลาบ",
            "แก้วตวงนม",
            "ผ้ากันเปื้อน",
            "ที่ปิดโซดา",
            "ที่ตีฟองนม");

        for($b = 0; $b < count($product_value); $b++)
        {
            $product_value[$b] = 0;
        }

        for($x = 0; $x < count($product_list); $x++)
        {

            for($z = 0; $z < count($list_name_product); $z++) {
                if ($product_list[$x][0] == $list_name_product[$z]) {
                    $product_value[$z] = $product_list[$x][2];
                    settype($product_value[$z], "integer");
                }
            }
        }

        $comment = null;
        $sheet_payoption = null;
        if($order_detail->comment == null) {
            $comment = "-";
        }
        if($order_detail->pay_option == "promtpay") {
            $sheet_payoption = "QR";
        }
        else if($order_detail->pay_option == "bank") {
            $sheet_payoption = "BANK";
        }
        else if($order_detail->pay_option == "destination") {
            $sheet_payoption = "COD";
        }
        else {
            $sheet_payoption = "-";
        }

        $append = [
            $order_detail->order_id,
			Carbon::parse($order_detail->created_at)->format('Y-m-d H:i:s'),
            $order_detail->order_by,
            $order_detail->order_branch,
            $product_value[0],
            $product_value[1],
            $product_value[2],
            $product_value[3],
            $product_value[4],
            $product_value[5],
            $product_value[6],
            $product_value[7],
            $product_value[8],
            $product_value[9],
            $product_value[10],
            $product_value[11],
            $product_value[12],
            $product_value[13],
            $product_value[14],
            $product_value[15],
            $product_value[16],
            $product_value[17],
            $product_value[18],
            $product_value[19],
            $product_value[20],
            $product_value[21],
            $product_value[22],
            $product_value[23],
            $order_detail->order_price,
            $order_detail->contact,
            $sheet_payoption,
            $comment,
        ];

        Sheets::spreadsheet('1VdS2QlTqRL9vfba1HncnH124QQ7TtWbnIFLhU0OPoRQ')
            ->sheet('Chapayom-OrderList1')
            ->append([$append]);

        return response()->json(['success']);
    }

}
