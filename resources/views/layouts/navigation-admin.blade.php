<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.attendances.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-alarm') }}"></use>
            </svg>
            {{ __('Pontos') }}
        </a>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link" href="{{ route('admin.importer.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-cloud-upload') }}"></use>
            </svg>
            {{ __('Importador') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.employees.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
            </svg>
            {{ __('Funcionários') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-fingerprint') }}"></use>
            </svg>
            {{ __('Usuários') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.configuration.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
            </svg>
            {{ __('Configurações') }}
        </a>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-description') }}"></use>
            </svg>
            {{ __('Relatórios') }}
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.by-manager') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg> Responsável
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.by-employee') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg> Funcionário
                </a>
            </li>
        </ul>

    </li>
</ul>
