<div class="card shadow-none border mb-3">
    <div class="card-body">
        <h5 class="mb-7">
            <i class="fas fa-chart-line me-2"></i>
            Trading Journal Entry
        </h5>
        <form id="tradingForm">
            
            <!-- Trade Basics Section (Blue) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h6 class="mb-0">Trade Basics</h6>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Market</label>
                    <select class="form-select form-select-sm" name="market" required>
                        <option value="">Select Market</option>
                        <option value="XAUUSD">XAUUSD</option>
                        <option value="EU">EURUSD</option>
                        <option value="GU">GBPUSD</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Session</label>
                    <select class="form-select form-select-sm" name="session" required>
                        <option value="">Select Session</option>
                        <option value="LO">London</option>
                        <option value="NY">New York</option>
                        <option value="AS">Asian</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control form-control-sm" name="date" required>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Time</label>
                    <input type="time" class="form-control form-control-sm" name="time">
                </div>
            </div>
            
            <!-- Performance Section (Green) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h6 class="mb-0">Performance</h6>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Direction</label>
                    <select class="form-select form-select-sm" name="direction" required>
                        <option value="">Select</option>
                        <option value="LONG">Long</option>
                        <option value="SHORT">Short</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Entry Price</label>
                    <input type="number" step="0.00001" class="form-control form-control-sm" name="entryPrice" placeholder="0.00000">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Exit Price</label>
                    <input type="number" step="0.00001" class="form-control form-control-sm" name="exitPrice" placeholder="0.00000">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">Outcome</label>
                    <select class="form-select form-select-sm" name="outcome">
                        <option value="">Select</option>
                        <option value="W">Win</option>
                        <option value="L">Loss</option>
                        <option value="BE">Break Even</option>
                        <option value="C">Cancelled</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">P/L %</label>
                    <input type="number" step="0.01" class="form-control form-control-sm" name="plPercent" placeholder="0.00">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label">RR</label>
                    <input type="number" step="0.01" class="form-control form-control-sm" name="rr" placeholder="0.00">
                </div>
            </div>
            
            <!-- Metrics Section (Purple) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h6 class="mb-0">Metrics</h6>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">Timeframes</label>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1m" id="tf1m">
                            <label class="form-check-label" for="tf1m">1m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="5m" id="tf5m">
                            <label class="form-check-label" for="tf5m">5m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="15m" id="tf15m">
                            <label class="form-check-label" for="tf15m">15m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1H" id="tf1h">
                            <label class="form-check-label" for="tf1h">1H</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="4H" id="tf4h">
                            <label class="form-check-label" for="tf4h">4H</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1D" id="tf1d">
                            <label class="form-check-label" for="tf1d">1D</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Section (Orange) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h6 class="mb-0">Charts</h6>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Higher Timeframe Chart</label>
                    <input type="url" class="form-control form-control-sm" name="chartHtf" placeholder="https://...">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Lower Timeframe Chart</label>
                    <input type="url" class="form-control form-control-sm" name="chartLtf" placeholder="https://...">
                </div>
            </div>
            
            <!-- Comments Section (Teal) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h6 class="mb-0">Comments</h6>
                </div>
                
                <div class="col-12">
                    <textarea class="form-control form-control-sm" name="comments" rows="4" placeholder="Add your trade notes and analysis..."></textarea>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-subtle-primary me-1 mb-1" id="submitBtn">
                        <i class="fas fa-save me-2"></i>
                        <span id="submitText">Save Trade Entry</span>
                        <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none"></span>
                    </button>
                </div>
            </div>
            
        </form>
        
        <!-- Success/Error Alerts -->
        <div id="alertContainer" class="mt-3"></div>
    </div>
</div>