import React, { useId, useState } from 'react';
import clsx from 'clsx';

import plusIconId from '../../../images/shared/icons/icon-plus.svg';

const FileInput = (
	{
		label = 'Загрузить файлы',
		id = undefined,
		disabled = false,
		invalid = false,
		multiple = false,
		accept = '',
		className = '',
		onChange = () => {
		},
	},
) => {
	const [dragActive, setDragActive] = useState(false);
	const internalId = useId();
	const inputId = id ?? internalId;

	const handleDrag = function(event) {
		event.preventDefault();
		event.stopPropagation();

		if (event.type === 'dragenter' || event.type === 'dragover') {
			setDragActive(true);
		} else if (event.type === 'dragleave') {
			setDragActive(false);
		}
	};

	const handleDrop = function(event) {
		event.preventDefault();
		event.stopPropagation();
		setDragActive(false);

		if (event.dataTransfer.files && event.dataTransfer.files[0]) {
			onChange([...event.dataTransfer.files]);
		}
	};

	const changeHandler = (event) => {
		onChange([...event.target.files]);
	};

	return (
		<div className={clsx('file-input', className)} onDragEnter={handleDrag}>
			<input type='file' id={inputId} disabled={disabled} multiple={multiple} accept={accept}
				   className='file-input__input visually-hidden'
				   onChange={changeHandler} />
			<label htmlFor={inputId} className={clsx('file-input__label', {
				'file-input__label--drag-active': dragActive,
				'file-input__label--error': invalid,
			})}>
				<span className={clsx('file-input__button', {
					'file-input__button--error': invalid,
				})}>
					<svg width='16' height='16' className={clsx('file-input__icon', {
						'file-input__icon--error': invalid,
					})} aria-hidden='true'>
						<use xlinkHref={`#${plusIconId}`} />
					</svg>
					{label}
				</span>
			</label>
			{dragActive && <div className='file-input__drag-element' onDragEnter={handleDrag} onDragLeave={handleDrag}
								onDragOver={handleDrag} onDrop={handleDrop} />}
		</div>
	);
};

export default FileInput;
