wp.blocks.registerBlockType('my-custom-blocks/cpt-slider', {
    edit: function (props) {
        const { useBlockProps, InspectorControls } = wp.blockEditor;
        const { PanelBody, SelectControl, Spinner, CheckboxControl } = wp.components;
        const { useState, useEffect, createElement } = wp.element;
        const apiFetch = wp.apiFetch;

        const { postType, taxonomy, terms } = props.attributes;
        const setAttributes = props.setAttributes;

        const blockProps = useBlockProps();

        const [postTypes, setPostTypes] = useState([]);
        const [taxonomies, setTaxonomies] = useState([]);
        const [allTerms, setAllTerms] = useState([]);
        const [posts, setPosts] = useState([]);
        const [loading, setLoading] = useState(false);
        const [activeTerm, setActiveTerm] = useState(null);

        // 🔹 Получение уровня вложенности
        const getLevel = (term, allTerms) => {
            let level = 0;
            let parent = term.parent;

            while (parent) {
                const p = allTerms.find(t => t.id === parent);
                if (!p) break;
                level++;
                parent = p.parent;
            }

            return level;
        };

        // CPT
        useEffect(() => {
            apiFetch({ path: '/wp/v2/types' }).then(res => {
                const pts = Object.values(res).map(pt => ({
                    label: pt.name,
                    value: pt.slug
                }));
                setPostTypes(pts);
            });
        }, []);

        // TAXONOMIES
        useEffect(() => {
            if (!postType) return;

            apiFetch({ path: `/wp/v2/taxonomies` }).then(res => {
                const tax = Object.values(res)
                    .filter(t => t.types.includes(postType))
                    .map(t => ({
                        label: t.name,
                        value: t.slug
                    }));

                setTaxonomies(tax);
            });
        }, [postType]);

        // TERMS
        useEffect(() => {
            if (!taxonomy) return;

            apiFetch({ path: `/wp/v2/${taxonomy}?per_page=100` })
                .then(res => {
                    setAllTerms(res);
                })
                .catch(() => setAllTerms([]));
        }, [taxonomy]);

        // POSTS
        useEffect(() => {
            if (!terms.length) {
                setPosts([]);
                return;
            }

            setLoading(true);

            apiFetch({
                path: `/wp/v2/${postType}?${taxonomy}=${terms.join(',')}&per_page=20&_embed=true`
            })
                .then(res => {
                    setPosts(res);
                    setLoading(false);
                })
                .catch(() => {
                    setPosts([]);
                    setLoading(false);
                });

        }, [postType, taxonomy, terms]);

        // активный таб по умолчанию
        useEffect(() => {
            if (terms.length && !activeTerm) {
                setActiveTerm(terms[0]);
            }
        }, [terms]);

        // фильтр
        const filteredPosts = activeTerm
            ? posts.filter(p => p[taxonomy]?.includes(activeTerm))
            : posts;

        // сортировка выбранных терминов
        const selectedTerms = terms
            .map(id => allTerms.find(t => t.id === id))
            .filter(Boolean);

        // UI — табы
        const tabs = selectedTerms.map(term => {
            return createElement(
                'button',
                {
                    key: term.id,
                    className: `category-tab ${activeTerm === term.id ? 'active' : ''}`,
                    onClick: () => setActiveTerm(term.id)
                },
                term.name
            );
        });

        // слайды
        const slides = filteredPosts.map(post => {
            const img = post._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';

            return createElement(
                'div',
                { className: 'swiper-slide', key: post.id },
                createElement(
                    'a',
                    { href: post.link, target: '_blank' },
                    img && createElement('img', { src: img }),
                    createElement('h3', { dangerouslySetInnerHTML: { __html: post.title.rendered } })
                )
            );
        });

        return createElement(
            'div',
            blockProps,

            createElement(InspectorControls, {},
                createElement(PanelBody, { title: 'Настройки', initialOpen: true },

                    createElement(SelectControl, {
                        label: 'Тип записей',
                        value: postType,
                        options: postTypes,
                        onChange: val => setAttributes({
                            postType: val,
                            taxonomy: '',
                            terms: []
                        })
                    }),

                    createElement(SelectControl, {
                        label: 'Таксономия',
                        value: taxonomy,
                        options: taxonomies,
                        onChange: val => setAttributes({
                            taxonomy: val,
                            terms: []
                        })
                    }),

                    createElement('div', { className: 'terms-checkboxes' },

                        allTerms.map(term => createElement(
                            CheckboxControl,
                            {
                                key: term.id,
                                label: '—'.repeat(getLevel(term, allTerms)) + ' ' + term.name,
                                checked: terms.includes(term.id),
                                onChange: (checked) => {
                                    let newTerms = [...terms];

                                    if (checked) {
                                        if (!newTerms.includes(term.id)) {
                                            newTerms.push(term.id);
                                        }
                                    } else {
                                        newTerms = newTerms.filter(id => id !== term.id);
                                    }

                                    setAttributes({ terms: newTerms });
                                }
                            }
                        ))
                    )
                )
            ),

            !terms.length && createElement('p', {}, 'Выберите категории'),

            createElement('div', { className: 'posts-slider-categories' }, tabs),

            loading
                ? createElement(Spinner)
                : createElement('div', { className: 'swiper' },
                    createElement('div', { className: 'swiper-wrapper' }, slides),
                    createElement('div', { className: 'swiper-button-next' }),
                    createElement('div', { className: 'swiper-button-prev' }),
                    createElement('div', { className: 'swiper-pagination' })
                )
        );
    },

    save: function () {
        return null;
    }
});