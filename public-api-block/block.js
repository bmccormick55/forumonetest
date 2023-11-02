const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType('public-api-block/block', {
    title: __('Public API Block', 'public-api-block'),
    category: 'common',
    edit: () => {
        return (
            <div>
                <p>{__('Fetching data from the public API...', 'public-api-block')}</p>
            </div>
        );
    },
    save: () => {
        return (
            <div>
                <p>{__('Data fetched from the public API', 'public-api-block')}</p>
            </div>
        );
    },
});
