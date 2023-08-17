import React, { useId } from 'react';
import clsx from 'clsx';

import ImageValueList from './ImageValueList';
import uploadIconId from '../../../images/shared/icons/icon-upload.svg';

const ImageInput = (
	{
		label = 'Прикрепить фото',
		value = [],
		invalid = false,
		id = undefined,
		className = '',
		onChange = () => {
		},
	},
) => {
	const internalId = useId();
	const inputId = id ?? internalId;

	const changeHandler = (event) => {
		onChange([...event.target.files]);
	}

	const removeImage = (index) => {
		const newImageList = [...value];
		newImageList.splice(index, 1);

		onChange(newImageList);
	}

	return (
		<div className={clsx('image-input', className)}>
			<input type='file' id={inputId} multiple accept='image/*' className='image-input__input visually-hidden'
				   onChange={changeHandler} />
			<label htmlFor={inputId} className={clsx('image-input__label', {
				'image-input__label--error': invalid,
			})}>
				<svg width='24' height='24' className='image-input__icon' aria-hidden='true'>
					<use xlinkHref={`#${uploadIconId}`} />
				</svg>
				{label}
			</label>
			{Boolean(value.length) && (
				<ImageValueList value={value} className='image-input__list' onImageButtonClick={removeImage} />)}
		</div>
	);
};

export default ImageInput;
