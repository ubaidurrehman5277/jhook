            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://futechsol.com" target="_blank">FuTechSol</a> {{ date('Y') }}</p>
            </div>
        </div>
        @php
            $__menus = DB::table('menus')->whereNull('main_menu')->get();
        @endphp
        <!-- Modal -->
        <div class="modal fade" id="basicModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Report</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Date From</label>
                                    <input type="date" class="date_from form-control" placeholder="Date From" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Date From</label>
                                    <input type="date" class="date_to form-control" placeholder="Date To" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Choose Main Menu</label>
                                    <select name="menu" class="form-control menu_drop">
                                        <option value="">Choose an Option</option>
                                        @forelse($__menus as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="hidden_url" value="">
                        <input type="hidden" class="hidden_type" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pr-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.m-call').click(function(){
                var url = $(this).attr('data-href');
                var type = $(this).attr('data-type');
                $('.hidden_url').val(url);
                $('.hidden_type').val(type);
                $('.modal-title').html($(this).attr('data-title'));
            });
            $('.pr-btn').click(function(){
                var date_from = $('.date_from').val().trim();
                var date_to = $('.date_to').val().trim();
                var type = $('.hidden_type').val().trim();
                var url = $('.hidden_url').val();
                url += "?pdf=true";
                if(date_from == "" || date_to == ""){
                    console.log(date_from+date_to);
                    alert('Please enter date from and date to for generate report');
                }else{
                    if(type == 'category')
                    {
                        var cat = $('.menu_drop').val().trim();
                        if (cat == "") 
                        {
                            alert('Please choose a Mein Menu');
                            return false;
                        }else{
                            url += "&cat="+cat;
                        }
                    }
                    var rt = validate_dates(date_from);
                    if(rt == 0){
                        alert('Please enter correct date from format (Y-M-D)');
                        return false;
                    }
                    var rt = validate_dates(date_to);
                    if(rt == 0){
                        alert('Please enter correct date to format (Y-M-D)');
                        return false;
                    }
                    url += "&date_from="+date_from;
                    url += "&date_to="+date_to;
                    window.open(url);
                    window.location.reload();
                }
            });
            function validate_dates($val){
                var d = $val.split('-');
                if(d.length != 3){
                    return 0;
                }else{
                    return 1;
                }
            }
        })
    </script>
</body>

</html>