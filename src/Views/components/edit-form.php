<form id="editTradeForm">
    <input type="hidden" name="editId" id="editId">
    
    <!-- Trade Basics Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h6 class="color-basics border-bottom border-basics pb-2 mb-3">Trade Basics</h6>
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-basics">Market</label>
            <select class="form-select border-basics" name="market" id="editMarket" required>
                <option value="">Select Market</option>
                <option value="XAUUSD">XAUUSD</option>
                <option value="EU">EURUSD</option>
                <option value="GU">GBPUSD</option>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-basics">Session</label>
            <select class="form-select border-basics" name="session" id="editSession" required>
                <option value="">Select Session</option>
                <option value="LO">London</option>
                <option value="NY">New York</option>
                <option value="AS">Asian</option>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-basics">Date</label>
            <input type="date" class="form-control border-basics" name="date" id="editDate" required>
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-basics">Time</label>
            <input type="time" class="form-control border-basics" name="time" id="editTime">
        </div>
    </div>
    
    <!-- Performance Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h6 class="color-performance border-bottom border-performance pb-2 mb-3">Performance</h6>
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">Direction</label>
            <select class="form-select border-performance" name="direction" id="editDirection" required>
                <option value="">Select</option>
                <option value="LONG">Long</option>
                <option value="SHORT">Short</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">Entry Price</label>
            <input type="number" step="0.00001" class="form-control border-performance" name="entryPrice" id="editEntryPrice">
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">Exit Price</label>
            <input type="number" step="0.00001" class="form-control border-performance" name="exitPrice" id="editExitPrice">
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">Outcome</label>
            <select class="form-select border-performance" name="outcome" id="editOutcome">
                <option value="">Select</option>
                <option value="W">Win</option>
                <option value="L">Loss</option>
                <option value="BE">Break Even</option>
                <option value="C">Cancelled</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">P/L %</label>
            <input type="number" step="0.01" class="form-control border-performance" name="plPercent" id="editPlPercent">
        </div>
        
        <div class="col-md-4">
            <label class="form-label color-performance">RR</label>
            <input type="number" step="0.01" class="form-control border-performance" name="rr" id="editRR">
        </div>
    </div>
    
    <!-- Metrics Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h6 class="color-metrics border-bottom border-metrics pb-2 mb-3">Metrics</h6>
        </div>
        
        <div class="col-12">
            <label class="form-label color-metrics">Timeframes</label>
            <div class="d-flex flex-wrap gap-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="1m" id="editTf1m">
                    <label class="form-check-label color-metrics" for="editTf1m">1m</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="5m" id="editTf5m">
                    <label class="form-check-label color-metrics" for="editTf5m">5m</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="15m" id="editTf15m">
                    <label class="form-check-label color-metrics" for="editTf15m">15m</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="1H" id="editTf1h">
                    <label class="form-check-label color-metrics" for="editTf1h">1H</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="4H" id="editTf4h">
                    <label class="form-check-label color-metrics" for="editTf4h">4H</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tf[]" value="1D" id="editTf1d">
                    <label class="form-check-label color-metrics" for="editTf1d">1D</label>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h6 class="color-charts border-bottom border-charts pb-2 mb-3">Charts</h6>
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-charts">Higher Timeframe Chart</label>
            <input type="url" class="form-control border-charts" name="chartHtf" id="editChartHtf">
        </div>
        
        <div class="col-md-6">
            <label class="form-label color-charts">Lower Timeframe Chart</label>
            <input type="url" class="form-control border-charts" name="chartLtf" id="editChartLtf">
        </div>
    </div>
    
    <!-- Comments Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h6 class="color-comments border-bottom border-comments pb-2 mb-3">Comments</h6>
        </div>
        
        <div class="col-12">
            <textarea class="form-control border-comments" name="comments" id="editComments" rows="3"></textarea>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="updateTradeBtn">
            <span id="updateText">Update Trade</span>
            <span id="updateSpinner" class="spinner-border spinner-border-sm ms-2 d-none"></span>
        </button>
    </div>
</form>