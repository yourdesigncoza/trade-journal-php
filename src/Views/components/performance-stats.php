<div class="card shadow-sm h-100">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">
            <i class="fas fa-chart-pie me-2"></i>
            Performance Analytics
        </h4>
    </div>
    <div class="card-body">
        <div id="performanceStats">
            <!-- Stats will be loaded by JavaScript -->
            <div class="text-center py-4">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Loading performance data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Performance Stats Template -->
<script type="text/template" id="performanceTemplate">
<div class="row g-3">
    <!-- Overview Stats -->
    <div class="col-12">
        <h6 class="text-success mb-3">
            <i class="fas fa-chart-line me-2"></i>Overview
        </h6>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-success">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-success mb-1">Total Trades</h6>
                <h4 class="mb-0 text-dark" id="totalTrades">0</h4>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-success">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-success mb-1">Win Rate</h6>
                <h4 class="mb-0 text-dark" id="winRate">0%</h4>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-success">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-success mb-1">Account Gain</h6>
                <h4 class="mb-0 text-dark" id="accountGain">0%</h4>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-success">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-success mb-1">Profit Factor</h6>
                <h4 class="mb-0 text-dark" id="profitFactor">0</h4>
            </div>
        </div>
    </div>
    
    <!-- Trade Breakdown -->
    <div class="col-12 mt-4">
        <h6 class="text-success mb-3">
            <i class="fas fa-list me-2"></i>Trade Breakdown
        </h6>
    </div>
    
    <div class="col-12">
        <div class="row g-2 text-center">
            <div class="col-3">
                <div class="border border-success rounded p-2">
                    <small class="text-success fw-bold">Wins</small>
                    <div class="fw-bold text-success" id="totalWins">0</div>
                </div>
            </div>
            <div class="col-3">
                <div class="border border-danger rounded p-2">
                    <small class="text-danger fw-bold">Losses</small>
                    <div class="fw-bold text-danger" id="totalLosses">0</div>
                </div>
            </div>
            <div class="col-3">
                <div class="border border-warning rounded p-2">
                    <small class="text-warning fw-bold">BE</small>
                    <div class="fw-bold text-warning" id="totalBE">0</div>
                </div>
            </div>
            <div class="col-3">
                <div class="border border-secondary rounded p-2">
                    <small class="text-secondary fw-bold">Cancel</small>
                    <div class="fw-bold text-secondary" id="totalCancelled">0</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Risk Metrics -->
    <div class="col-12 mt-4">
        <h6 class="text-success mb-3">
            <i class="fas fa-shield-alt me-2"></i>Risk Metrics
        </h6>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-info">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-info mb-1">Avg RR</h6>
                <h5 class="mb-0 text-dark" id="avgRR">0</h5>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-info">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-info mb-1">Best Trade</h6>
                <h5 class="mb-0 text-dark" id="bestTrade">0%</h5>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-warning">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-warning mb-1">Worst Trade</h6>
                <h5 class="mb-0 text-dark" id="worstTrade">0%</h5>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="card bg-light border-info">
            <div class="card-body p-3 text-center">
                <h6 class="card-title text-info mb-1">Avg P/L</h6>
                <h5 class="mb-0 text-dark" id="avgPL">0%</h5>
            </div>
        </div>
    </div>
</div>
</script>