     <!-- rumahsehat -->

     <div id="rumahsehat" class="tab-pane fade">
         @if($rumahsehat->isEmpty())
         <td>DATA KOSONG</td>
         @else
         <h6>I. Identitas</h6>
         <table>
             <tbody>
                 @foreach($rumahsehat as $rumahsehat)
                 <tr>
                     <td>NIK</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nik_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Nama Lengkap</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nama_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Jenis Kelamin</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->jenis_kelamin_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Tanggal Lahir</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->tanggal_lahir_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Umur</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->umur_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Berat Badan Lahir</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->bb_lahir_rumahsehat}}
                     </td>
                 </tr>


                 <tr>
                     <td>Panjang Badan Lahir</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->pb_lahir_rumahsehat}}
                     </td>
                 </tr>

                 <tr>
                     <td>Berat Badan Saat Ini</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->bb_rumahsehat}}
                     </td>
                 </tr>


                 <tr>
                     <td>Panjang Badan Saat Ini</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->pb_rumahsehat}}
                     </td>
                 </tr>

                 <tr>
                     <td>Lila</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->lila_rumahsehat}}
                     </td>
                 </tr>

                 <tr>
                     <td>Cara Ukur Panjang Balita</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->cara_ukur_pb_rumahsehat}}
                     </td>
                 </tr>


             </tbody>
         </table><br>

         <h6>II. Data Orang Tua</h6>
         <table>
             <tbody>
                 <tr>
                     <td>NIK Ayah</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nik_ayah_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Nama Ayah</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nama_ayah_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>NIK Ibu</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nik_ibu_rumahsehat}}</td>
                 </tr>
                 <tr>
                     <td>Nama Ibu</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->nama_ibu_rumahsehat}}</td>
                 </tr>
             </tbody>
         </table><br>

         <h6>III. Alamat</h6>
         <table>
             <tbody>
                 <tr>
                     <td>Alamat Lengkap Domisili</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->alamat_domisili_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>RT/RW</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->rt_rumahsehat}}/{{$rumahsehat->rw_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Alamat Lengkap KTP</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->alamat_ktp_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>No Hp</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->no_hp_ortu_rumahsehat}}</td>
                 </tr>

                 @endforeach
             </tbody>
         </table>

         <h6>IV. Perkembangan balita</h6>
         <table>
             <tbody>
                 <tr>
                     <td>Status</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->status_rumahsehat}}</td>
                 </tr>


                 <tr>
                     <td>Perkembangan Balita (Sesuai Buku KIA)</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                     </td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->perkembangan_balita_rumahsehat}}</td>
                 </tr>

                 <tr>
                     <td>Foto Kegiatan</td>
                     <td>
                     <td>
                     <td>
                     <td>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                     <td>&nbsp;&nbsp;{{$rumahsehat->foto_rumahsehat}}</td>
                 </tr>

                 @endforeach
             </tbody>
         </table>
         @endif
     </div>