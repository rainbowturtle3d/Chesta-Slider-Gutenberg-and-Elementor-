/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import Edit from './edit';
import Save from './save';
import metadata from './block.json';

/**
 * Register the Chesta Slider block.
 */
registerBlockType(metadata.name, {
    ...metadata,
    edit: Edit,
    save: Save,
});

