import React, { useId } from 'react';
import clsx from 'clsx';
import { Menu, Item, useContextMenu } from 'react-contexify';

import DocumentFileItem from './DocumentFileItem';
import { router } from '@inertiajs/react';

const MENU_ID = 'file-context-menu';

const DocumentFileList = (
	{
		title = '',
		hiddenTitle = false,
		directories = [],
		files = [],
		emptyMessage = 'В директории нет файлов',
		className = '',
	},
) => {
	const titleId = useId();
	const { show: showContextMenu } = useContextMenu({
		id: MENU_ID,
	});

	function handleItemClick({ props }) {
		if (window.confirm('Вы уверены?')) {
			router.delete(route('client.maintenance.documents.destroy', props.path), {
				preserveScroll: true,
			});
		}
	}

	function displayMenu(event, path) {
		showContextMenu({
			event: event,
			props: {
				path: path,
			},
		});
	}

	return (
		<div className={clsx('document-file-list', className)} aria-labelledby={titleId}>
			<h3 id={titleId} className={clsx({
				'title title--small document-file-list__title': !hiddenTitle,
				'visually-hidden': hiddenTitle,
			})}>{title}</h3>
			{Boolean(directories.length) || Boolean(files.length) ? (
				<ul className='document-file-list__list'>
					{files.map((file) => (
						<DocumentFileItem key={file.path} as='li' {...file}
										  onContextMenu={file.type !== 'directory-up' ? displayMenu : undefined} />
					))}
				</ul>
			) : (
				<p className='document-file-list__empty'>{emptyMessage}</p>
			)}
			<Menu id={MENU_ID} className='context-menu'>
				<Item onClick={handleItemClick}>Удалить</Item>
			</Menu>
		</div>
	);
};

export default DocumentFileList;
