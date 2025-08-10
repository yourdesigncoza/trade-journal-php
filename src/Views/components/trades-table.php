<div class="card shadow-none border mb-3" data-component-card="data-component-card">
    <div class="card-header p-4 border-bottom bg-body">
        <div class="row g-3 justify-content-between align-items-center">
            <div class="col-12 col-md">
                <h4 class="text-body mb-0">
                    <i class="fas fa-table me-2"></i>
                    Trading History
                </h4>
            </div>
            <div class="col col-md-auto">
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm" id="searchInput" 
                           placeholder="Search trades..." style="width: 200px;">
                    <button class="btn btn-outline-secondary btn-sm" id="refreshTable">
                        <i class="fas fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="table-list" id="tradingHistoryTable">
            <div class="table-responsive scrollbar mb-3">
                <table class="table table-sm fs-9 mb-0 overflow-hidden" id="tradesTable">
                <thead class="text-body">
                    <tr>
                        <th class="sort ps-2 pe-1" data-sort="date">Date</th>
                        <th class="sort ps-2 pe-1" data-sort="date">Time</th>
                        <th class="sort text-center" data-sort="market">Market</th>
                        <th class="sort text-center" data-sort="session">Session</th>
                        <th class="sort text-center" data-sort="direction">Direction</th>
                        <th class="sort text-end" data-sort="entryPrice">Entry</th>
                        <th class="sort text-end" data-sort="exitPrice">Exit</th>
                        <th class="sort text-center" data-sort="outcome">Status</th>
                        <th class="sort text-center" data-sort="plPercent">P/L %</th>
                        <th class="sort text-center" data-sort="rr">RR</th>
                        <th class="text-center">TF</th>
                        <th class="text-center">Charts <i class="fas fa-chart-area ms-1"></i></th>
                        <th class="text-center">Notes <i class="fas fa-comment ms-1"></i></th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody class="list" id="tradesTableBody">
                    <!-- Data will be loaded by JavaScript -->
                    <tr>
                        <td colspan="13" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-body-tertiary mb-0 fs-8">Loading trades...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Trade Row Template -->
<script type="text/template" id="tradeRowTemplate">
<tr class="btn-reveal-trigger" data-trade-id="{{id}}">
    <td class="py-2 ps-3">
        <div class="fw-semibold">{{date}}</div>
        {{#if time}}<div class="fs-9 text-body-tertiary">{{time}}</div>{{/if}}
    </td>
    <td class="py-2 fw-bold">
        <span class="badge badge-phoenix badge-phoenix-primary">{{market}}</span>
    </td>
    <td class="py-2">
        <span class="badge badge-phoenix badge-phoenix-secondary">{{session}}</span>
    </td>
    <td class="py-2">
        {{#if direction}}
            <span class="badge badge-phoenix {{#eq direction 'LONG'}}badge-phoenix-success{{else}}badge-phoenix-danger{{/eq}}">
                {{direction}}
            </span>
        {{/if}}
    </td>
    <td class="py-2 text-end fw-medium">
        {{#if entryPrice}}{{entryPrice}}{{else}}-{{/if}}
    </td>
    <td class="py-2 text-end fw-medium">
        {{#if exitPrice}}{{exitPrice}}{{else}}-{{/if}}
    </td>
    <td class="py-2 text-center">
        {{#if outcome}}
            <span class="badge badge-phoenix 
                {{#eq outcome 'W'}}badge-phoenix-success{{/eq}}
                {{#eq outcome 'L'}}badge-phoenix-danger{{/eq}}
                {{#eq outcome 'BE'}}badge-phoenix-warning{{/eq}}
                {{#eq outcome 'C'}}badge-phoenix-secondary{{/eq}}
            ">
                {{#eq outcome 'W'}}Win <i class="fas fa-check ms-1"></i>{{/eq}}
                {{#eq outcome 'L'}}Loss <i class="fas fa-times ms-1"></i>{{/eq}}
                {{#eq outcome 'BE'}}Break Even <i class="fas fa-minus ms-1"></i>{{/eq}}
                {{#eq outcome 'C'}}Cancelled <i class="fas fa-ban ms-1"></i>{{/eq}}
            </span>
        {{else}}
            <span class="badge badge-phoenix badge-phoenix-secondary">Pending</span>
        {{/if}}
    </td>
    <td class="py-2 text-end fw-medium">
        {{#if plPercent}}
            <span class="{{#gt plPercent 0}}text-success{{else}}text-danger{{/gt}}">
                {{plPercent}}%
            </span>
        {{else}}-{{/if}}
    </td>
    <td class="py-2 text-end fw-medium">
        {{#if rr}}{{rr}}{{else}}-{{/if}}
    </td>
    <td class="py-2">
        {{#if tf}}
            {{#each tf}}
                <span class="badge badge-phoenix badge-phoenix-info me-1">{{this}}</span>
            {{/each}}
        {{else}}-{{/if}}
    </td>
    <td class="py-2">
        {{#if chartHtf}}<a href="{{chartHtf}}" target="_blank" class="btn btn-sm btn-phoenix-primary me-1"><i class="fas fa-chart-line"></i></a>{{/if}}
        {{#if chartLtf}}<a href="{{chartLtf}}" target="_blank" class="btn btn-sm btn-phoenix-primary"><i class="fas fa-chart-area"></i></a>{{/if}}
        {{#unless chartHtf}}{{#unless chartLtf}}-{{/unless}}{{/unless}}
    </td>
    <td class="py-2">
        {{#if comments}}
            <button class="btn btn-sm btn-phoenix-info" title="{{comments}}" data-bs-toggle="tooltip">
                <i class="fas fa-comment"></i>
            </button>
        {{else}}-{{/if}}
    </td>
    <td class="py-2">
        <div class="dropstart position-static d-inline-block">
            <button class="btn btn-link text-body btn-sm dropdown-toggle btn-reveal" type="button" 
                    id="trade-dropdown-{{id}}" data-bs-toggle="dropdown" data-boundary="window" 
                    aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                <i class="fas fa-ellipsis fs-9"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="trade-dropdown-{{id}}">
                <a href="#!" class="dropdown-item edit-trade" data-trade-id="{{id}}">Edit</a>
                <div class="dropdown-divider"></div>
                <a href="#!" class="dropdown-item text-danger delete-trade" data-trade-id="{{id}}">Delete</a>
            </div>
        </div>
    </td>
</tr>
</script>

<!-- Empty State Template -->
<script type="text/template" id="emptyStateTemplate">
<tr>
    <td colspan="13" class="text-center py-4">
        <i class="fas fa-chart-line fs-1 text-body-tertiary mb-3 d-block"></i>
        <h6 class="text-body-secondary fs-7">No trades found</h6>
        <p class="text-body-tertiary mb-0 fs-8">Start by adding your first trade entry above.</p>
    </td>
</tr>
</script>