
function pdfAdherent(){

	var docDefinition = { content: 'exemple' };
	// open the PDF in a new window
 	pdfMake.createPdf(docDefinition).open();

 	// print the PDF
 	pdfMake.createPdf(docDefinition).print();

	 // download the PDF
 	pdfMake.createPdf(docDefinition).download('exemple.pdf');
  
}