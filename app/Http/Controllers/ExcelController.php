<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\IOFactory;


class ExcelController extends Controller

{

   

   function index()

   {

       $data = DB::table('customer')->orderBy('id', 'DESC')->paginate(5);

       return view('welcome', compact('data'));

   }
   public function customer_data_delete($id)
   {
    $delete=DB::table('customer')->where('id',$id)->delete();
    return redirect()->back();
   }




   
   function importData(Request $request){




       $this->validate($request, [

           'uploaded_file' => 'required|file|mimes:xls,xlsx'

       ]);




       $the_file = $request->file('uploaded_file');

       try{

           $spreadsheet = IOFactory::load($the_file->getRealPath());

           $sheet        = $spreadsheet->getActiveSheet();

           $row_limit    = $sheet->getHighestDataRow();

           $column_limit = $sheet->getHighestDataColumn();

           $row_range    = range( 2, $row_limit );

           $column_range = range( 'F', $column_limit );

           $startcount = 2;




           $data = array();




           foreach ( $row_range as $row ) {

               $data[] = [


                   'Description' => $sheet->getCell( 'B' . $row )->getValue(),

                   'Amount' => $sheet->getCell( 'C' . $row )->getValue()




               ];

               $startcount++;

           }




           DB::table('customer')->insert($data);

       } catch (Exception $e) {

           $error_code = $e->errorInfo[1];




           return back()->withErrors('There was a problem uploading the data!');

       }

       return back()->withSuccess('Great! Data has been successfully uploaded.');




   }



}