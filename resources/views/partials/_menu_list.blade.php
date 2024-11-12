
<li>
    <a href="{{ route('home') }}" class="{{ Request::is('index') ? 'active':'' }}">
        <span class="nav-icon uil uil-home"></span>
        <span class="menu-text">{{ trans('menu.home') }}</span>
    </a>
</li>
@hasanyrole('Pastor General|Anciano|Administrador')
<li>
    <a href="{{ route('districts.index') }}" class="{{ Request::is('districts') || Request::is('districts/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-create-dashboard"></span>
        <span class="menu-text">Distritos</span>
    </a>
</li>
@endhasanyrole
@hasanyrole('Pastor de Distrito|Pastor General|Anciano|Administrador')
<li>
    <a href="{{ route('zones.index') }}" class="{{ Request::is('zones') || Request::is('zones/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-create-dashboard"></span>
        <span class="menu-text">Zonas</span>
    </a>
</li>
@endhasanyrole
@hasanyrole('Pastor de Zona|Pastor de Distrito|Pastor General|Anciano|Administrador')
<li>
    <a href="{{ route('sectors.index') }}" class="{{ Request::is('sectors') || Request::is('sectors/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-create-dashboard"></span>
        <span class="menu-text">Sectores</span>
    </a>
</li>
@endhasanyrole
@hasanyrole('Líder|Supervisor|Administrador')
<li>
    <a href="{{ route('cells.index') }}" class="{{ Request::is('cells') || Request::is('cells/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-create-dashboard"></span>
        <span class="menu-text">Célula</span>
    </a>
</li>
@endhasanyrole
<li>
    <a href="{{ route('members.index') }}" class="{{ Request::is('members') || Request::is('members/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-users-alt"></span>
        <span class="menu-text">Miembros</span>
    </a>
</li>
@hasrole('Líder')
<li>
    <a href="{{ route('reports.index') }}" class="{{ Request::is('reports') || Request::is('reports/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-chart"></span>
        <span class="menu-text">Reporte de célula</span>
    </a>
</li>
@endhasrole
@unlessrole('Líder')
<li class="has-child {{ Request::is('reports') || Request::is('report/*') ? 'open':'' }}">
    <a href="#" class="{{ Request::is('reports') || Request::is('report/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-chart"></span>
        <span class="menu-text">Reportes</span>
        <span class="toggle-icon"></span>
    </a>
    <ul>
        @hasanyrole('Pastor General|Anciano|Administrador')
        <li>
            <a href="{{ route('reports.general') }}" class="{{ Request::is('report/general') ? 'active':'' }}">
                <span class="menu-text">Reporte General</span>
            </a>
        </li>
        <li>
            <a href="{{ route('reports.stat-general') }}" class="{{ Request::is('report/stat-general') ? 'active':'' }}">
                <span class="menu-text">Estadístico General</span>
            </a>
        </li>
        @endhasanyrole
        @hasanyrole('Pastor de Distrito|Pastor General|Anciano|Administrador')
        <li>
            <a href="{{ route('reports.districts') }}" class="{{ Request::is('report/districts') ? 'active':'' }}">
                <span class="menu-text">Reporte de distrito</span>
            </a>
        </li>
        @endhasanyrole
        @hasanyrole('Pastor de Zona|Pastor de Distrito|Pastor General|Anciano|Administrador')
        <li>
            <a href="{{ route('reports.zones') }}" class="{{ Request::is('report/zones') ? 'active':'' }}">
                <span class="menu-text">Reporte de zona</span>
            </a>
        </li>
        @endhasanyrole
        @hasanyrole('Supervisor|Pastor de Zona|Pastor de Distrito|Pastor General|Anciano|Administrador')
        <li>
            <a href="{{ route('reports.sectors') }}" class="{{ Request::is('report/sectors') ? 'active':'' }}">
                <span class="menu-text">Reporte de sector</span>
            </a>
        </li>
        @endhasanyrole
        <li>
            <a href="{{ route('reports.index') }}" class="{{ Request::is('reports') || Request::is('reports/*') ? 'active':'' }}">
                <span class="menu-text">Reporte de célula</span>
            </a>
        </li>
    </ul>
</li>
@endunlessrole
<li>
    <a href="{{ route('church-attendances.index') }}" class="{{ Request::is('church-attendances') || Request::is('church-attendances/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-house-user"></span>
        <span class="menu-text">Asistencia al templo</span>
    </a>
</li>
@hasanyrole('Supervisor|Pastor de Zona|Pastor de Distrito|Pastor General|Anciano|Administrador')
<li>
    <a href="{{ route('supervision-attendances.index') }}" class="{{ Request::is('supervision-attendances') || Request::is('supervision-attendances/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-house-user"></span>
        <span class="menu-text">Asistencia reunión de supervisión</span>
    </a>
</li>
@endhasanyrole
@hasanyrole('Pastor de Zona|Pastor de Distrito|Pastor General|Anciano|Administrador')
<li>
    <a href="{{ route('events.index') }}" class="{{ Request::is('events') || Request::is('events/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-calendar-alt"></span>
        <span class="menu-text">Eventos</span>
    </a>
</li>
@endhasanyrole
<li>
    <a href="{{ route('supports.index') }}" class="{{ Request::is('supports') || Request::is('supports/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-question-circle"></span>
        <span class="menu-text">Atención y Ayuda</span>
    </a>
</li>
@hasrole('Administrador')
<li>
    <a href="{{ route('users.index') }}" class="{{ Request::is('users') || Request::is('users/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-users-alt"></span>
        <span class="menu-text">Usuarios</span>
    </a>
</li>
<li>
    <a href="{{ route('roles.index') }}" class="{{ Request::is('roles') || Request::is('roles/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-users-alt"></span>
        <span class="menu-text">Roles</span>
    </a>
</li>
@endhasrole
