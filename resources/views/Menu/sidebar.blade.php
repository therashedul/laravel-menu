<nav class="sidebar card py-2 mb-4 text-left">
    <h3>Sidebar Menu</h3>
    <ul class="nav flex-column">
        @foreach ($topNavItems3 as $nav)
            @if (!empty($nav->children[0]))
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        @if ($nav->name == null)
                            {{ $nav->title }}
                        @else
                            {{ $nav->name }}
                        @endif
                    </a>
                    <ul class="submenu dropdown-menu">
                        @foreach ($nav->children[0] as $child)
                            <li>
                                @if ($child->type == 'category')
                                    <a class="dropdown-item nav-link" href="{{ $child->slug }}"
                                        target="{{ $child->target }}">
                                        @if ($child->name == null)
                                            {{ $child->title }}
                                        @else
                                            {{ $child->name }}
                                        @endif
                                        <b class="float-end">&raquo;</b>
                                    </a>
                                @elseif ($child->type == 'page')
                                    <a class="dropdown-item nav-link" href="{{ route('pages', $child->slug) }}">
                                        @if ($child->name == null)
                                            {{ $child->title }}
                                        @else
                                            {{ $child->name }}
                                        @endif
                                        <b class="float-end">&raquo;</b>
                                    </a>
                                @elseif ($child->type == 'post')
                                    <a class="dropdown-item nav-link" href="{{ $child->slug }}"
                                        target="{{ $child->target }}">
                                        @if ($child->name == null)
                                            {{ $child->title }}
                                        @else
                                            {{ $child->name }}
                                        @endif
                                        <b class="float-end">&raquo;</b>
                                    </a>
                                @elseif ($child->type == 'custom')
                                    <a class="dropdown-item nav-link" href="{{ $child->slug }}"
                                        target="{{ $child->target }}">
                                        @if ($child->name == null)
                                            {{ $child->title }}
                                        @else
                                            {{ $child->name }}
                                        @endif
                                        <b class="float-end">&raquo;</b>
                                    </a>
                                @endif
                                {{-- ======================== --}}
                                @if (isset($child->children))
                                    @foreach ($child->children as $value)
                                        <ul class="submenu dropdown-menu">
                                            @foreach ($value as $val)
                                                <li>
                                                    @if ($val->type == 'category')
                                                        <a class="dropdown-item nav-link" href="{{ $val->slug }}"
                                                            target="{{ $val->target }}">
                                                            @if ($val->name == null)
                                                                {{ $val->title }}
                                                            @else
                                                                {{ $val->name }}
                                                            @endif
                                                        </a>
                                                    @elseif ($val->type == 'page')
                                                        <a class="dropdown-item nav-link" href="{{ $val->slug }}"
                                                            target="{{ $val->target }}">
                                                            @if ($val->name == null)
                                                                {{ $val->title }}
                                                            @else
                                                                {{ $val->name }}
                                                            @endif
                                                        </a>
                                                    @elseif ($val->type == 'post')
                                                        <a class="dropdown-item nav-link" href="{{ $val->slug }}"
                                                            target="{{ $val->target }}">
                                                            @if ($val->name == null)
                                                                {{ $val->title }}
                                                            @else
                                                                {{ $val->name }}
                                                            @endif
                                                        </a>
                                                    @elseif ($val->type == 'custom')
                                                        <a class="dropdown-item nav-link" href="{{ $val->slug }}"
                                                            target="{{ $val->target }}">
                                                            @if ($val->name == null)
                                                                {{ $val->title }}
                                                            @else
                                                                {{ $val->name }}
                                                            @endif
                                                        </a>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                @endif
                                {{-- ========================= --}}
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                @if ($nav->type == 'category')
                    <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                            target="{{ $nav->target }}">
                            @if ($nav->name == null)
                                {{ $nav->title }}
                            @else
                                {{ $nav->name }}
                            @endif
                        </a>
                    </li>
                @elseif ($nav->type == 'page')
                    {{-- {{ route('page/unpublish', $value->id) }} --}}
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('pages', $nav->slug) }}"
                            target="{{ $nav->target }}">
                            @if ($nav->name == null)
                                {{ $nav->title }}
                            @else
                                {{ $nav->name }}
                            @endif
                        </a>
                    </li>
                @elseif ($nav->type == 'post')
                    <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                            target="{{ $nav->target }}">
                            @if ($nav->name == null)
                                {{ $nav->title }}
                            @else
                                {{ $nav->name }}
                            @endif
                        </a>
                    </li>
                @elseif ($nav->type == 'custom')
                    <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                            target="{{ $nav->target }}">
                            @if ($nav->name == null)
                                {{ $nav->title }}
                            @else
                                {{ $nav->name }}
                            @endif
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</nav>
