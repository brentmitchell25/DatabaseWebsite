var function writeRows() {
    var table = document.getElementById('ticker-table');
    var row = table.insertRow(1);
    row.insertCell(0).innerHTML = "<td class='m-ticker'><b>BRDM</b><span></span></td>";
    row.insertCell(1).innerHTML = "<td class='m-price'>33.27</td>";
    row.insertCell(2).innerHTML = "<td class='m-change'><i class='fa fa-angle-up'></i> 1.45 (27&#37;)</td>";
    row.insertCell(3).innerHTML = "<td class='td-graph'></td>";
}
 
var function getOutput() {
   $.ajax({
      url:'../dashboard.php',
      complete: function (response) {
          $('#dashboard-overview').html(response.responseText);
      },
      error: function () {
          $('#output').html('Bummer: there was an error!');
      }
  });
  return false;
}
