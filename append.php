<?php
    include "conn/database.php";
    $db = new database();

    foreach($db->tampil_periode() as $tPer)
    {
        if($tPer['status'] == 1)
        {
            $idA = $tPer['id_periode'];
        }
    }

    foreach($db->tampil_satuan() as $tampilS)
    {
        if($tampilS['id_satuan'] == $_GET['id5'])
        {
            $nSAS = $tampilS['nama_satuan'];
        }
    }
    foreach($db->tampil_polarisasi() as $tPol)
    {
        if($tPol['id_polarisasi'] == $_GET['id_sifat'])
        {
            $nPAS = $tPol['nama_polarisasi'];
        }
    }

    $html = '
        <tr id="hapusan'.$_GET['param'].'">
            <td><input type="text" value="'.$_GET['id1'].'" class="form-control" name="kpi[]"></td>
            <td><textarea name="deskripsi[]" id="" cols="30" rows="0" class="form-control">'.$_GET['id2'].'</textarea></td>
            <td><input type="text" value="'.$_GET['id3'].'" class="form-control" name="bobot[]"></td>
            <td><input type="text" value="'.$_GET['id4'].'" class="form-control" name="sasaran[]"></td>
            <td>';
    $html .=   '<select id="satuan'.$_GET['param'].'" name="satuan[]" class="select" style="width:100%;" onchange="fungsi1('.$_GET['param'].')">
                    <option value="">Silahkan Pilih Satuan</option>';
                        $a = '';
                        foreach($db->tampil_satuan($idA) as $tampil)
                        {
                            if($tampil['nama_satuan'] == $nSAS)
                                $a = 'selected="selected"';
                            $html .= '<option value="'.$tampil['id_satuan'].'" '.$a.'>'.$tampil['nama_satuan'].'</option>';
                            $a = '';
                        }
    $html .=   '</select>
            </td>
            <td>
                <select id="sifat_kpi'.$_GET['param'].'" name="sifat_kpi[]" class="select" style="width:100%;">';
                foreach($db->tampil_satuan($idA) as $tampil)
                {
                    if($tampil['nama_satuan'] == $nSAS)
                    {
                        $a = '';
                        foreach(unserialize($tampil['jenis_polarisasi']) as $key => $value)
                        {
                            foreach($db->tampil_polarisasi() as $tampilP)
                            {
                                if($tampilP['id_polarisasi'] == $value)
                                    $ket = $tampilP['nama_polarisasi'];
                            }
                            
                            if($nPAS == $ket)
                                $a = 'selected="selected"';
                            $html .= '<option value="'.$value.'" '.$a.'>'.$ket.'</option>';
                            $a = '';
                        }
                    }
                }
    $html .=    '</select>
            </td>
            <td>
                <button class="btn btn-danger" onclick="fungsi4('.$_GET['param'].')">Hapus</button>
            </td>
        </tr>

        <script>
            $(".select").select2({
                placeholder: "Please Select"
            });

            function fungsi1(param = 0){
				var v1 = "#satuan"+param;
                var v2 = "#sifat_kpi"+param;
                var v3 = "sifat_kpi"+param;
                var id = $(v1).children(":selected").attr("value");
				document.getElementById(v3).innerHTML = "";
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					var result = JSON.parse(data);
					$.each(result, function (index, value) {
						var jenis_polarisasi = value.id_polarisasi;
						var ket = value.nama_polarisasi;

						$(v2).append($("<option/>", { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			}
        </script>
    ';

    echo $html;
?>