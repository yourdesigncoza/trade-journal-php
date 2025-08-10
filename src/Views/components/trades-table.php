<div class="card shadow-none border mb-3" data-component-card="data-component-card">
    <div class="card-body p-4">
        <div class="row g-3 justify-content-between align-items-center mb-5">
            <div class="col-12 col-md">
                <h5 class="text-body mb-0">
                    <i class="fas fa-bar-chart me-2"></i>
                    Trading History
                </h5>
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
</div>