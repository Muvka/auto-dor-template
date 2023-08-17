import React from 'react';
import { Link } from '@inertiajs/react';
import clsx from 'clsx';

const types = ['file', 'directory', 'directory-up'];

const DocumentFileItem = (
	{
		as = 'div',
		type = 'file',
		name = 'Файл',
		description = '',
		path = '',
		className = '',
		onContextMenu = () => {},
	},
) => {
	const checkedType = types.includes(type) ? type : types[0];
	const Container = as.toLowerCase();

	return (
		<Container className={clsx('document-file-item', `document-file-item--${checkedType}`, className)}
				   onContextMenu={(event) => onContextMenu(event, path)}>
			<div className='document-file-item__text-container'>
				<p className='document-file-item__name'>
					{type === 'file' ? (
						<a href={route('client.maintenance.documents.download', path)} className='document-file-item__link'>{name}</a>
					) : (
						<Link href={route('client.maintenance.documents.view', path)} className='document-file-item__link'>{name}</Link>
					)}
				</p>
				{Boolean(description) && <p className='document-file-item__description'>{description}</p>}
			</div>
		</Container>
	);
};

export default DocumentFileItem;
