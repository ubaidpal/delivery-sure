<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{url('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo">
                <i class="fa fa-fw fa-users"></i>
                User Management <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($approveCollapse)) {
                $ApproveCollapse = $approveCollapse;
            } else {
                $ApproveCollapse = 'collapse';
            }
            ?>
            <ul id="demo" class="{{$ApproveCollapse}}">
                <li>
                    @if(isset($approveColor))
                        <a style="{{$approveColor}}" href="{{url('admin/users')}}">Approved Users</a>
                    @else
                        <a href="{{url('admin/users')}}">Approved Users</a>
                    @endif

                </li>
                <li>
                    @if(isset($pendingColor))
                        <a style="{{$pendingColor}}" href="{{url('admin/pending-approvals')}}">Pending Approvals</a>
                    @else
                        <a href="{{url('admin/pending-approvals')}}">Pending Approvals</a>
                    @endif

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#transaction">
                <i class="fa fa-fw fa-money"></i>
                Transactions <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($transactionCollapse)) {
                $transCollapse = $transactionCollapse;
            } else {
                $transCollapse = 'collapse';
            }
            ?>
            <ul id="transaction" class="{{$transCollapse}}">
                <li>
                    @if(isset($transColor))
                        <a style="{{$transColor}}" href="{{url('admin/transactions')}}">All Transaction</a>
                    @else
                        <a href="{{url('admin/transactions')}}">All Transaction</a>
                    @endif

                </li>
            </ul>

        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#withdraw">
                <i class="fa fa-fw fa-money"></i>
                Withdraw <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($WithdrawalCollapse)) {
                $withDrawCollapse = $WithdrawalCollapse;
            } else {
                $withDrawCollapse = 'collapse';
            }
            ?>
            <ul id="withdraw" class="{{$withDrawCollapse}}">
                <li>
                    @if(isset($WithdrawalColor))
                        <a style="{{$WithdrawalColor}}" href="{{url('admin/withdrawalRequests')}}">Payment</a>
                    @else
                        <a href="{{url('admin/withdrawalRequests')}}">Payment</a>
                    @endif

                </li>
                <li>
                    @if(isset($WithdrawalColor))
                        <a style="{{$WithdrawalColor}}" href="{{url('admin/withdrawalRequests')}}">Other Amount</a>
                    @else
                        <a href="{{url('admin/withdrawalRequests')}}">Other Amount</a>
                    @endif
                </li>
            </ul>

        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#flagged">
                <i class="fa fa-fw fa-money"></i>Flagged
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="flagged" class="collapse @if(Request::is('admin/flagged/*')) in @endif">
                <li>
                    <a style="@if(Request::is('admin/flagged/all')) color: #fff @endif" href="{{route('flagged.all')}}">All</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#profileSetting">
                <i class="fa fa-fw fa-gear"></i> Settings
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($passwordChange)) {
                $passChange = $passwordChange;
            } else {
                $passChange = 'collapse';
            }
            ?>
            <ul id="profileSetting" class="{{$passChange}}">
                <li>
                    @if(isset($passwordColor))
                        <a style="{{$passwordColor}}" href="{{url('admin/changePassword')}}">Change Password</a>
                    @else
                        <a href="{{url('admin/changePassword')}}">Change Password</a>
                    @endif

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#Refer">
                <i class="fa fa-fw fa-gear"></i> Refer
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($refer)) {
                $referChange = $refer;
            } else {
                $referChange = 'collapse';
            }
            ?>
            <ul id="Refer" class="{{$referChange}}">
                <li>
                    @if(isset($referColor))
                        <a style="{{$referColor}}" href="{{url('admin/userRefer')}}">Reference</a>
                    @else
                        <a href="{{url('admin/userRefer')}}">Refer</a>
                    @endif

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#Messages">
                <i class="fa fa-fw fa-gear"></i> Messages
                <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <?php
            if(isset($messages)) {
                $messagesChange = $messages;
            } else {
                $messagesChange = 'collapse';
            }
            ?>
            <ul id="Messages" class="{{$messagesChange}}">
                <li>
                    @if(isset($messagesColor))
                        <a style="{{$messagesColor}}" href="{{url('admin/users/purchaser')}}">Messages</a>
                    @else
                        <a href="{{url('admin/users/purchaser')}}">Messages</a>
                    @endif

                </li>
            </ul>
        </li>

    </ul>
</div>
