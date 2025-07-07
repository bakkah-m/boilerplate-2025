import './bootstrap';
import './dataTable';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import { DataTable } from 'simple-datatables';

window.Alpine = Alpine;
window.DataTable = DataTable;
window.Chart = Chart;

Alpine.start();
