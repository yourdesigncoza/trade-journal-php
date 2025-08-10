<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="fas fa-chart-line me-2"></i>
            Trading Journal Entry
        </h4>
    </div>
    <div class="card-body">
        <form id="tradingForm">
            
            <!-- Trade Basics Section (Blue) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h5 class="color-basics border-bottom border-basics pb-2 mb-3">
                        <i class="fas fa-coins me-2"></i>Trade Basics
                    </h5>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label color-basics">Market</label>
                    <select class="form-select border-basics" name="market" required>
                        <option value="">Select Market</option>
                        <option value="XAUUSD">XAUUSD</option>
                        <option value="EU">EURUSD</option>
                        <option value="GU">GBPUSD</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label color-basics">Session</label>
                    <select class="form-select border-basics" name="session" required>
                        <option value="">Select Session</option>
                        <option value="LO">London</option>
                        <option value="NY">New York</option>
                        <option value="AS">Asian</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label color-basics">Date</label>
                    <input type="date" class="form-control border-basics" name="date" required>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label color-basics">Time</label>
                    <input type="time" class="form-control border-basics" name="time">
                </div>
            </div>
            
            <!-- Performance Section (Green) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h5 class="color-performance border-bottom border-performance pb-2 mb-3">
                        <i class="fas fa-trending-up me-2"></i>Performance
                    </h5>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">Direction</label>
                    <select class="form-select border-performance" name="direction" required>
                        <option value="">Select</option>
                        <option value="LONG">Long</option>
                        <option value="SHORT">Short</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">Entry Price</label>
                    <input type="number" step="0.00001" class="form-control border-performance" name="entryPrice" placeholder="0.00000">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">Exit Price</label>
                    <input type="number" step="0.00001" class="form-control border-performance" name="exitPrice" placeholder="0.00000">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">Outcome</label>
                    <select class="form-select border-performance" name="outcome">
                        <option value="">Select</option>
                        <option value="W">Win</option>
                        <option value="L">Loss</option>
                        <option value="BE">Break Even</option>
                        <option value="C">Cancelled</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">P/L %</label>
                    <input type="number" step="0.01" class="form-control border-performance" name="plPercent" placeholder="0.00">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label color-performance">RR</label>
                    <input type="number" step="0.01" class="form-control border-performance" name="rr" placeholder="0.00">
                </div>
            </div>
            
            <!-- Metrics Section (Purple) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h5 class="color-metrics border-bottom border-metrics pb-2 mb-3">
                        <i class="fas fa-chart-bar me-2"></i>Metrics
                    </h5>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label color-metrics">Timeframes</label>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1m" id="tf1m">
                            <label class="form-check-label color-metrics" for="tf1m">1m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="5m" id="tf5m">
                            <label class="form-check-label color-metrics" for="tf5m">5m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="15m" id="tf15m">
                            <label class="form-check-label color-metrics" for="tf15m">15m</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1H" id="tf1h">
                            <label class="form-check-label color-metrics" for="tf1h">1H</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="4H" id="tf4h">
                            <label class="form-check-label color-metrics" for="tf4h">4H</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tf[]" value="1D" id="tf1d">
                            <label class="form-check-label color-metrics" for="tf1d">1D</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Section (Orange) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h5 class="color-charts border-bottom border-charts pb-2 mb-3">
                        <i class="fas fa-image me-2"></i>Charts
                    </h5>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label color-charts">Higher Timeframe Chart</label>
                    <input type="url" class="form-control border-charts" name="chartHtf" placeholder="https://...">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label color-charts">Lower Timeframe Chart</label>
                    <input type="url" class="form-control border-charts" name="chartLtf" placeholder="https://...">
                </div>
            </div>
            
            <!-- Comments Section (Teal) -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <h5 class="color-comments border-bottom border-comments pb-2 mb-3">
                        <i class="fas fa-comment me-2"></i>Comments
                    </h5>
                </div>
                
                <div class="col-12">
                    <textarea class="form-control border-comments" name="comments" rows="4" placeholder="Add your trade notes and analysis..."></textarea>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg w-100" id="submitBtn">
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