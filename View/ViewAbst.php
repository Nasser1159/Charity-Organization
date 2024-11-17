<?php
class ViewAbst {
    function PrintFooter() {
        echo("
        </table>
        </div>
        </div>
        <footer>
            <p>© 2024 Food Bank</p>
        </footer>
        </body>
        </html>");
    }
    function PrintMessage($succ, $method =null) {
        if ($succ){
            echo('<p style="color: green; text-align: center; font-size:large; margin-top: 250px;">
            Operation was Successfull !</p>');
    if($method != null)
       {     echo('<p style="color: green; text-align: center; font-size:large;">
            using '.$method.' </p>');
        }
    }
        else echo('<p style="color: red; text-align: center; font-size:large; margin-top: 250px;">
            Operation was not Executed !</p>');
    }
    
}