<form id="editTradeForm">
    <input type="hidden" name="editId" id="editId">
    
    <!-- Trade Basics Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label text-primary">
                <i class="fas fa-globe me-2"></i>Market
            </label>
            <select class="form-select form-select-sm" name="market" id="editMarket" required>
                <option value="">Select Market</option>
                <option value="XAUUSD">XAUUSD</option>
                <option value="EU">EURUSD</option>
                <option value="GU">GBPUSD</option>
                <option value="UJ">USDJPY</option>
                <option value="US30">US30</option>
                <option value="NAS100">NAS100</option>
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-primary">
                <i class="fas fa-clock me-2"></i>Session
            </label>
            <select class="form-select form-select-sm" name="session" id="editSession" required>
                <option value="">Select Session</option>
                <option value="LO">London</option>
                <option value="NY">New York</option>
                <option value="AS">Asia</option>
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-primary">
                <i class="fas fa-calendar me-2"></i>Date
            </label>
            <input type="date" class="form-control form-control-sm" name="date" id="editDate" required>
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-primary">
                <i class="fas fa-clock me-2"></i>Time
            </label>
            <input type="time" class="form-control form-control-sm" name="time" id="editTime">
        </div>
    </div>
    
    <!-- Performance Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label text-success">
                <i class="fas fa-trending-up me-2"></i>Direction
            </label>
            <select class="form-select form-select-sm" name="direction" id="editDirection" required>
                <option value="">Select</option>
                <option value="LONG">Long</option>
                <option value="SHORT">Short</option>
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-success">
                <i class="fas fa-dollar-sign me-2"></i>Entry Price
            </label>
            <input type="number" step="0.00001" class="form-control form-control-sm" name="entryPrice" id="editEntryPrice">
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-success">
                <i class="fas fa-dollar-sign me-2"></i>Exit Price
            </label>
            <input type="number" step="0.00001" class="form-control form-control-sm" name="exitPrice" id="editExitPrice">
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-success">
                <i class="fas fa-chart-bar me-2"></i>Outcome
            </label>
            <select class="form-select form-select-sm" name="outcome" id="editOutcome">
                <option value="">Select</option>
                <option value="W">Win</option>
                <option value="L">Loss</option>
                <option value="BE">Break Even</option>
                <option value="C">Cancelled</option>
            </select>
        </div>
    </div>
    
    <!-- Metrics Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label text-info">
                <i class="fas fa-chart-bar me-2"></i>P/L %
            </label>
            <input type="number" step="0.01" class="form-control form-control-sm" name="plPercent" id="editPlPercent">
        </div>
        
        <div class="col-md-3">
            <label class="form-label text-info">
                <i class="fas fa-chart-bar me-2"></i>RR
            </label>
            <input type="number" step="0.01" class="form-control form-control-sm" name="rr" id="editRR">
        </div>
        
        <div class="col-md-6">
            <label class="form-label text-info">
                <i class="fas fa-search me-2"></i>Timeframes
            </label>
            <div class="row g-2">
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="1m" id="editTf1m">
                        <label class="form-check-label" for="editTf1m">1m</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="5m" id="editTf5m">
                        <label class="form-check-label" for="editTf5m">5m</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="15m" id="editTf15m">
                        <label class="form-check-label" for="editTf15m">15m</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="1H" id="editTf1h">
                        <label class="form-check-label" for="editTf1h">1H</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="4H" id="editTf4h">
                        <label class="form-check-label" for="editTf4h">4H</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="1D" id="editTf1d">
                        <label class="form-check-label" for="editTf1d">Daily</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="form-label text-warning">
                <i class="fas fa-chart-line me-2"></i>Higher Timeframe Chart
            </label>
            <input type="url" class="form-control form-control-sm" name="chartHtf" id="editChartHtf">
        </div>
        
        <div class="col-md-6">
            <label class="form-label text-warning">
                <i class="fas fa-chart-area me-2"></i>Lower Timeframe Chart
            </label>
            <input type="url" class="form-control form-control-sm" name="chartLtf" id="editChartLtf">
        </div>
    </div>
    
    <!-- Comments Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <label class="form-label text-info">
                <i class="fas fa-comment me-2"></i>Comments
            </label>
            <textarea class="form-control form-control-sm" name="comments" id="editComments" rows="3"></textarea>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-subtle-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-subtle-primary" id="updateTradeBtn">
            <span id="updateText">Update Trade</span>
            <span id="updateSpinner" class="spinner-border spinner-border-sm ms-2 d-none"></span>
        </button>
    </div>
</form>