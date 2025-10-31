import { html, useConfig } from "gridjs";

export default function PaginationSelector() {
  const limit = useConfig((config) => config.pagination.limit);

  return html(`
    <div class="flex items-center gap-2">
      <p>Display</p>
      <select class="select select-bordered"
        id="gridjs-pagination-selector"
        onchange="this.dispatchEvent(new CustomEvent('pagination-selector', { detail: this.value, bubbles: true }))">
        <option value="10" ${limit === 10 ? "selected" : ""}>10</option>
        <option value="25" ${limit === 25 ? "selected" : ""}>25</option>
        <option value="50" ${limit === 50 ? "selected" : ""}>50</option>
        <option value="100" ${limit === 100 ? "selected" : ""}>100</option>
      </select>
    </div>
  `);
}
