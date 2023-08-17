import React, { useEffect, useId, useRef } from 'react';
import { router, useForm, usePage } from '@inertiajs/react';

import TextInput from '../Shared/TextInput';

const visitOptions = {
	only: ['isSearch', 'files'],
	preserveScroll: true,
	preserveState: true,
};

const DocumentsSearchForm = ({ className = '' }) => {
	const { path = '/' } = usePage().props;
	const { data, setData, get } = useForm('DocumentSearchForm', {
		search: '',
	});
	const inputId = useId();
	const prevValue = useRef(data.search);
	const timerId = useRef(null);

	useEffect(() => {
		if (prevValue.current !== data.search) {
			if (timerId.current !== null) {
				clearTimeout(timerId.current);
				timerId.current = null;
			}

			timerId.current = setTimeout(() => {
				prevValue.current = data.search;

				// TODO: Исправить баг и заменить на route('client.maintenance.documents.index', encodeURI(path))
				if (data.search) {
					get(`/closed/documents/root/${encodeURI(path)}`, visitOptions);
				} else {
					router.visit(`/closed/documents/root/${encodeURI(path)}`, visitOptions);
				}
			}, 400);
		}

		return () => {
			if (timerId.current !== null) {
				clearTimeout(timerId.current);
				timerId.current = null;
			}
		};
	}, [data.search]);

	return (
		<div className={className}>
			<label htmlFor={inputId} className='visually-hidden'>Поиск по документам</label>
			<TextInput type='search' id={inputId} value={data.search} placeholder='Поиск'
					   onChange={(event) => {
						   setData('search', event.target.value);
					   }} />
		</div>
	);
};

export default DocumentsSearchForm;
