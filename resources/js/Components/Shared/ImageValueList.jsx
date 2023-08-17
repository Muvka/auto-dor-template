import React, { useEffect, useState } from 'react';
import clsx from 'clsx';

import crossIconId from '../../../images/shared/icons/icon-cross.svg';

const ImageValueList = ({ value = [], className = '', onImageButtonClick = () => {} }) => {
	const [imageUrls, setImageUrls] = useState([]);

	useEffect(() => {
		if (value.length) {
			const newImageUrls = value.map((image) => {
				return URL.createObjectURL(image);
			});

			setImageUrls(newImageUrls);
		} else {
			setImageUrls([]);
		}
	}, [value]);

	return (
		<ul className={clsx('image-value-list', className)}>
			{imageUrls.map((imageUrl, index) => (
				<li key={imageUrl} className='image-value-list__item'>
					<img src={imageUrl} alt='' className='image-value-list__image' />
					<button type='button' className='image-value-list__button' aria-label='Убрать изображение' onClick={() => {
						onImageButtonClick(index);
					}}>
						<svg width='16' height='16' className='image-value-list__icon' aria-hidden='true'>
							<use xlinkHref={`#${crossIconId}`} />
						</svg>
					</button>
				</li>
			))}
		</ul>
	);
};

export default ImageValueList;
