<div class="card shadow-none border mb-3" data-component-card="data-component-card">
   <div class="card-body p-4">
      <h5 class="text-body mb-5">
         <i class="fas fa-table me-2"></i>
         Journal Your Trades
      </h5>
      <form id="tradingForm">
         <!-- Trade Basics Section -->
         <div class="row g-3 mb-4">
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-globe me-2 text-primary"></i>Market
               </label>
               <select class="form-select form-select-sm" name="market" required>
                  <option value="">Select an option</option>
                  <option value="XAUUSD">XAUUSD</option>
                  <option value="EU">EURUSD</option>
                  <option value="GU">GBPUSD</option>
                  <option value="UJ">USDJPY</option>
                  <option value="US30">US30</option>
                  <option value="NAS100">NAS100</option>
               </select>
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-clock me-2 text-primary"></i>Session
               </label>
               <select class="form-select form-select-sm" name="session" required>
                  <option value="">Select an option</option>
                  <option value="LO">London</option>
                  <option value="NY">New York</option>
                  <option value="AS">Asia</option>
               </select>
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-calendar me-2 text-primary"></i>Date
               </label>
               <input type="date" class="form-control form-control-sm" name="date" required>
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-clock me-2 text-primary"></i>Time
               </label>
               <input type="time" class="form-control form-control-sm" name="time">
            </div>
         </div>
         <!-- Performance Section -->
         <div class="row g-3 mb-4">
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-trending-up me-2 text-success"></i>Direction
               </label>
               <select class="form-select form-select-sm" name="direction" required>
                  <option value="">Select an option</option>
                  <option value="LONG">Long</option>
                  <option value="SHORT">Short</option>
               </select>
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-dollar-sign me-2 text-success"></i>Entry Price
               </label>
               <input type="number" step="0.00001" class="form-control form-control-sm" name="entryPrice" placeholder="0.00000">
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-dollar-sign me-2 text-success"></i>Exit Price
               </label>
               <input type="number" step="0.00001" class="form-control form-control-sm" name="exitPrice" placeholder="0.00000">
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-chart-bar me-2 text-success"></i>Outcome
               </label>
               <select class="form-select form-select-sm" name="outcome">
                  <option value="">Select an option</option>
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
               <label class="form-label">
               <i class="fas fa-chart-bar me-2 text-info"></i>P/L %
               </label>
               <input type="number" step="0.01" class="form-control form-control-sm" name="plPercent" placeholder="0.00">
            </div>
            <div class="col-md-3">
               <label class="form-label">
               <i class="fas fa-chart-bar me-2 text-info"></i>RR
               </label>
               <input type="number" step="0.01" class="form-control form-control-sm" name="rr" placeholder="1.0">
            </div>
            <div class="col-md-6">
               <label class="form-label">
               <i class="fas fa-search me-2 text-info"></i>TF
               </label>
               <div class="row g-2">
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="5m" id="tf5m">
                        <label class="form-check-label" for="tf5m">5m</label>
                     </div>
                  </div>
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="15m" id="tf15m">
                        <label class="form-check-label" for="tf15m">15m</label>
                     </div>
                  </div>
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="30m" id="tf30m">
                        <label class="form-check-label" for="tf30m">30m</label>
                     </div>
                  </div>
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="1H" id="tf1h">
                        <label class="form-check-label" for="tf1h">1H</label>
                     </div>
                  </div>
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="4H" id="tf4h">
                        <label class="form-check-label" for="tf4h">4H</label>
                     </div>
                  </div>
                  <div class="col-auto">
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tf[]" value="1D" id="tf1d">
                        <label class="form-check-label" for="tf1d">Daily</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Charts Section -->
         <div class="row g-3 mb-4">
            <div class="col-md-6">
               <label class="form-label">
               <i class="fas fa-chart-line me-2 text-warning"></i>Chart HTF
               </label>
               <input type="url" class="form-control form-control-sm" name="chartHtf" placeholder="https://www.tradingview.com/...">
            </div>
            <div class="col-md-6">
               <label class="form-label">
               <i class="fas fa-chart-area me-2 text-warning"></i>Chart LTF
               </label>
               <input type="url" class="form-control form-control-sm" name="chartLtf" placeholder="https://www.tradingview.com/...">
            </div>
         </div>
         <!-- Comments Section -->
         <div class="row g-3 mb-4">
            <div class="col-12">
               <label class="form-label">
               <i class="fas fa-comment me-2 text-info"></i>Comments
               </label>
               <textarea class="form-control form-control-sm" name="comments" rows="3" placeholder="Add any additional notes about this trade..."></textarea>
            </div>
         </div>
         <!-- Submit Button -->
         <div class="row">
            <div class="col-12">
               <button type="submit" class="btn btn-subtle-primary px-5" id="submitBtn">
               <i class="fas fa-save me-2"></i>
               <span id="submitText">Save Trade Entry</span>
               <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none"></span>
               </button>
            </div>
         </div>
      </form>
   </div>
</div>