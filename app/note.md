MENU KITS :
1. MC Part List (diprint) ---> Menu MC	
    step :
	a. MC print part list
	b. MC prepare by slip
	c. Create QR label manual
	d. Scan label for record
	e. Issue To Receiving
	
2. MC Schedule KIT & Service parts ---> Menu MC	
    -  Create Scheduler for part(SA90, SB98)
     step 1:
	a.upload schedule
	   1. Selling/service part compare dengan SB98
	   2. SKD part compare dengan SA90
	b.share link schedule
	c.print part list

    Step 2:
    - Upload std pack (Add Input Manual)
        NIK
        Part Number
        Part Name
        Length
        Width
        Height
        Gross Weight
        Std. Qty
	
3. MC Performance / KIT WEB ---> Menu MC		
4. KIT & Service Parts Process ---> Menu Repacking KIT
     step :
	a. Receive Part
	b. Print QR label kit refer to mc scan result	
	c. scan QR label
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