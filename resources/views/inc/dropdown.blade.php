@if (auth()->user())
    @php
        $user = auth()->user();
        $locales = $user->company->locales ?? [];
    @endphp

    <div class="px-3  w-100">
        <div class="dropdown w-100 mb-4">
            <button class="btn btn-outline-light border  dropdown-toggle w-100 text-start " type="button"
                data-bs-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="false">
                <div class="d-inline-block text-sm"
                    style="width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; line-height:1;">
                    {!! session()->get(\App\Models\Locale::ACTIVE_LOCALE_NAME) ?? 'Choisissez une adresse' !!}
                </div>
            </button>
            <ul class="dropdown-menu w-100" data-bs-theme="light">

                @foreach ($locales as $locale)
                    <li
                        class="dropdown-item text-sm d-flex justify-content-between align-items-center
                
                @if ($locale->id == session()->get(\App\Models\Locale::ACTIVE_LOCALE)) active @endif">
                        <div class="d-flex align-items-center">
                            @if ($locale->id == session()->get(\App\Models\Locale::ACTIVE_LOCALE))
                                <div class="text-info me-2" style="width: 1.3rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <a class="text-decoration-none d-block" id="locale-{{ $locale->id }}"
                                    href="{{ route('locales.set-active', $locale) }}"
                                    style="display:block; width:100%; overflow:hidden; text-overflow:ellipsis; white-space:wrap;">
                                    {!! $locale->displayName !!}
                                </a>
                            </div>
                        </div>
                        {{-- ------- DROP DOWN ----- --}}
                        <section>
                            <div class="dropdown">
                                <button class="btn btn-light p-1 _dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <x-icon_dots />
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        {{-- trigger a livewire edit-locale --}}
                                        <button class="dropdown-item btn_edit_locale" type="button"
                                            id="edit-locale-{{ $locale->id }}" data-id="{{ $locale->id }}">
                                            <x-icon_edit />
                                            Modifier
                                        </button>
                                    </li>
                                    @if (!$locale->is_primary)
                                        <li>
                                            {{-- trigger a liveware delete-locale --}}
                                            <button class="dropdown-item text-danger" type="button">
                                                <x-icon_trash />
                                                Supprimer
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                        </section>
                        {{-- ------- END____DROP DOWN ----- --}}
                    </li>
                @endforeach
                <li>
                    <hr class="dropdown-divider">
                    <button class="dropdown-item" id="btnNewLocale">
                        <x-icon_add />
                        Ajouter une adresse
                    </button>
                </li>
            </ul>
        </div>

    </div>

@endif
