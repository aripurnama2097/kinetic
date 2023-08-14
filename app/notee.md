MENU KITS :
1. Master schedule(OK)
    a. std pack
	b. schedule tentative
	c. schedule release
	
2. MC Schedule KIT & Service parts ---> Menu MC	 (OK_)
 
	a.partlist schedule
	b.print partlist
	c.scan in  :
		1. MC prepare by slip
		2. Create QR label manual
		3. Scan label for record
		4. Issue To Receiving
	
3. KIT & Service Parts Process ---> Menu Repacking KIT
     step :
	a. Assy Category
	b. Original Category
		step : 
			1. Print QR label kit refer to mc scan result	
			2. scan QR label
	c. Combine Category
	Receive Part (data from mc scan in) OK

	d. Repack/ or Combine
		- Create part list for master box
	e. measurement
	f. stacking skid
	g. marking identification SKID(With QR)
	h. scan QR Skid	
	i. Marking indetification+count total box+measuring
5. Schedule KIT & Service parts ---> Menu Repacking KIT		
6. Scan out  ---> Menu General	
- Borrowing Part :
- Returning Part (Inv number)	



 
  

Acivity 05/05:
1. Discuss User perihal content print KIT label category Assy,
   Untuk part mecha belum ada label.,
   - solusi : ambil data dari schedule berdasarkan partno dan cust PO paling atas(asc)
2. Merge label proses issue ke planning di proses receiving dengan kondisi partno sama, PO berbeda ( agar proses print   
   kit label hanya dilakukan 1x)
   - Solusi :berdasarkan std pack
3. progress development: 
	- schedule : untuk master baru proses upload schedule dan std pack, -3 sb98, sa90, ada beberapa item master yang belum diupload.

MoM Kickoff 12/05:
1. case untuk label lebih dari 1 dalam 1 box, permintaan saat proses scan 2x tapi data yang masuk untuk kit hanya 1 dan merger qty, dengan opsi penambahan optional untuk memilih label single/double untuk scan.
2. proses borrowing saat pengembalian teknisnya seperti apa,  discuss sebelumnya dari proses MC didelete semua kemudian 
diawali dari awal proses, namun ada kendala ketika part yang di borrow berbeda partlist itu yang menjadi problem  MC untuk mengetahui part tersebut yang ada dipartlist.



====================================
proses issue seperti biasa, 
# print label dengan manual punya pa yunus?

gmn caranya menandakan loose carton, continue, common, 

combine selain dilakukan saat scan.




    <?php if ($value->balance_issue == 0) {
        echo '<tr style="background-color:#00c292;">';
   } else {
       echo '<tr style="background-color:#f5f5f5;">';
          
   }?>