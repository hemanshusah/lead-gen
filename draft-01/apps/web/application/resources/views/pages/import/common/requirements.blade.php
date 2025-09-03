<div class="importing-requirements">

    <div class="splash-image">
        <img src="{{ url('/') }}/public/images/system-checks.png" alt="404 - Not found" />
    </div>
    <div class="splash-text">
        @lang('lang.server_requirements_to_use_feature')
    </div>
    <table class="table table-sm table-bordered m-b-40 m-t-30">
        <!--check-->
        @if(!$requirements['iconv'])
        <tr>
            <td class="p-l-15">
                PHP Extension - iconv
            </td>
            <td class="x-td-checks text-align-center">
                <span class="x-checks x-check-failed text-danger"><i class="sl-icon-close"></i></span>
            </td>
        </tr>
        @endif

        <!--check-->
        @if(!$requirements['simplexml'])
        <tr>
            <td class="p-l-15">
                PHP Extension - simplexml
            </td>
            <td class="x-td-checks text-align-center">
                <span class="x-checks x-check-failed text-danger"><i class="sl-icon-close"></i></span>
            </td>
        </tr>
        @endif

        <!--check-->
        @if(!$requirements['xmlreader'])
        <tr>
            <td class="p-l-15">
                PHP Extension - xmlreader
            </td>
            <td class="x-td-checks text-align-center">
                <span class="x-checks x-check-failed text-danger"><i class="sl-icon-close"></i></span>
            </td>
        </tr>
        @endif

        <!--check-->
        @if(!$requirements['zlib'])
        <tr>
            <td class="p-l-15">
                PHP Extension - zlib
            </td>
            <td class="x-td-checks text-align-center">
                <span class="x-checks x-check-failed text-danger"><i class="sl-icon-close"></i></span>
            </td>
        </tr>
        @endif
    </table>

    @if(config('system.settings_type') == 'standalone')
    <!--[standalone] - settings documentation help-->
    @endif
    
</div>