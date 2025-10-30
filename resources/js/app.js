import './bootstrap';
// import './dataTable';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
// import { DataTable } from 'simple-datatables';
import { Grid, html, PluginPosition, h } from "gridjs";
import "gridjs/dist/theme/mermaid.css";


window.Alpine = Alpine;
// window.DataTable = DataTable;
window.Chart = Chart;
window.Grid = Grid;
window.html = html;


Alpine.start();
