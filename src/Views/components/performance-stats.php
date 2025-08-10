<div class="card shadow-none border mb-3" data-component-card="data-component-card">
   <div class="card-body p-4">
      <div class="row g-3 justify-content-between align-items-center mb-5">
         <div class="col-12 col-md">
            <h5 class="text-body mb-0 mt-2">
               <i class="fas fa-chart-pie me-2"></i>
               Trade Performance & Statistics
            </h5>
            <p class="text-body-tertiary mb-0 fs-9">Key statistics based on <span id="statsTradeCount">0</span> trades.</p>
         </div>
      </div>
      <div id="performanceStats">
         <!-- Stats will be loaded by JavaScript -->
         <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
               <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-body-tertiary mb-0 fs-8">Loading performance data...</p>
         </div>
      </div>
   </div>
</div>
<!-- Performance Stats Template -->
<script type="text/template" id="performanceTemplate">
   <ul class="list-group list-group-flush">
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Win Rate</div>
               <div class="fs-10 text-body-tertiary"><span id="totalWins">0</span>W / <span id="totalLosses">0</span>L</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-success" id="winRate">0%</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Account Gain</div>
               <div class="fs-10 text-body-tertiary">Total P/L across all trades</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-success" id="accountGain">0%</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Average RR</div>
               <div class="fs-10 text-body-tertiary">Risk-reward ratio average</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-info" id="avgRR">0</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Total Trades</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-primary" id="totalTrades">0</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Best Trade</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-success" id="bestTrade">0%</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Worst Trade</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-secondary" id="worstTrade">0%</span>
       </li>
       
       <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
           <div>
               <div class="fw-semibold text-body fs-9">Profit Factor</div>
           </div>
           <span class="badge badge-phoenix fs-10 badge-phoenix-success" id="profitFactor">0</span>
       </li>
   </ul>
</script>