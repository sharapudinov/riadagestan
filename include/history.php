<div class="den_v_istorii">
    <div class="zagolovok_fon">
        <h2 class="zagolovok_text">День в истории</h2>
    </div>
    <div class="den_v_istorii2">
        <div class="tekushaya_data">
            <script language="javascript" type="text/javascript">
                var d = new Date();
                var month = new Array("января", "февраля", "марта", "апреля", "мая", "июня",
                    "июля", "августа", "сентября", "октября", "ноября", "декабря");
                document.write(d.getDate() + " " + month[d.getMonth()]);
            </script>
        </div>


        <ul class="v_etot_den"> <?
            $masshistory = file("include/list.txt");
            $datehistory = date('d.m');
            foreach ($masshistory as $chhistory) {
                $mhistory = explode("##", $chhistory);
                if ($mhistory[0] == $datehistory) {
                    echo "<li> " . $mhistory[1] . "</li>";
                }
            }

            ?>
        </ul>
    </div>
</div>
