<div class="card shadow-sm">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-table me-2"></i>
            Trading History
        </h4>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" id="searchInput" 
                   placeholder="Search trades..." style="width: 200px;">
            <button class="btn btn-light btn-sm" id="refreshTable">
                <i class="fas fa-refresh"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tradesTable">
                <thead class="table-light">
                    <tr>
                        <th class="sortable" data-sort="date">
                            Date <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="market">
                            Market <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="session">
                            Session <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="direction">
                            Direction <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="entryPrice">
                            Entry <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="exitPrice">
                            Exit <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="outcome">
                            Outcome <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="plPercent">
                            P/L % <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th class="sortable" data-sort="rr">
                            RR <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th>TF</th>
                        <th>Charts</th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tradesTableBody">
                    <!-- Data will be loaded by JavaScript -->
                    <tr>
                        <td colspan="13" class="text-center py-4">
                            <div class="spinner-border text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted mb-0">Loading trades...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Trade Row Template -->
<script type="text/template" id="tradeRowTemplate">
<tr data-trade-id="{{id}}">
    <td><small>{{date}}</small><br><small class="text-muted">{{time}}</small></td>
    <td><span class="badge bg-primary">{{market}}</span></td>
    <td><span class="badge bg-secondary">{{session}}</span></td>
    <td>
        {{#if direction}}
            <span class="badge {{#eq direction 'LONG'}}bg-success{{else}}bg-danger{{/eq}}">
                {{direction}}
            </span>
        {{/if}}
    </td>
    <td>{{#if entryPrice}}{{entryPrice}}{{else}}-{{/if}}</td>
    <td>{{#if exitPrice}}{{exitPrice}}{{else}}-{{/if}}</td>
    <td>
        {{#if outcome}}
            <span class="badge 
                {{#eq outcome 'W'}}bg-success{{/eq}}
                {{#eq outcome 'L'}}bg-danger{{/eq}}
                {{#eq outcome 'BE'}}bg-warning{{/eq}}
                {{#eq outcome 'C'}}bg-secondary{{/eq}}
            ">{{outcome}}</span>
        {{else}}-{{/if}}
    </td>
    <td>
        {{#if plPercent}}
            <span class="{{#gt plPercent 0}}text-success{{else}}text-danger{{/gt}}">
                {{plPercent}}%
            </span>
        {{else}}-{{/if}}
    </td>
    <td>{{#if rr}}{{rr}}{{else}}-{{/if}}</td>
    <td>
        {{#if tf}}
            {{#each tf}}
                <span class="badge bg-info me-1">{{this}}</span>
            {{/each}}
        {{else}}-{{/if}}
    </td>
    <td>
        {{#if chartHtf}}<a href="{{chartHtf}}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-line"></i></a>{{/if}}
        {{#if chartLtf}}<a href="{{chartLtf}}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-chart-area"></i></a>{{/if}}
        {{#unless chartHtf}}{{#unless chartLtf}}-{{/unless}}{{/unless}}
    </td>
    <td>
        {{#if comments}}
            <button class="btn btn-sm btn-outline-info" title="{{comments}}" data-bs-toggle="tooltip">
                <i class="fas fa-comment"></i>
            </button>
        {{else}}-{{/if}}
    </td>
    <td>
        <div class="btn-group btn-group-sm">
            <button class="btn btn-outline-primary edit-trade" data-trade-id="{{id}}" title="Edit">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-outline-danger delete-trade" data-trade-id="{{id}}" title="Delete">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
</script>

<!-- Empty State Template -->
<script type="text/template" id="emptyStateTemplate">
<tr>
    <td colspan="13" class="text-center py-5">
        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">No trades found</h5>
        <p class="text-muted mb-0">Start by adding your first trade entry above.</p>
    </td>
</tr>
</script>