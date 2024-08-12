<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<livewire:partials.main-heading :heading="'Checkout'"/>
	<form wire:submit.prevent="submitOrder" class="grid grid-cols-12 gap-4">
		<div class="col-span-12 md:col-span-12 lg:col-span-8">
			<!-- Card -->
			<div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
				<!-- Shipping Address -->
				<div class="mb-6">
					<h2 class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
						Shipping Address
					</h2>
					<div class="grid grid-cols-2 gap-4">
						<div>
							<label class="block mb-1 text-gray-700 dark:text-white" for="first_name">
								First Name
							</label>
							<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="first_name" wire:model="first_name" type="text">
							</input>
							@error('first_name')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
						<div>
							<label class="block mb-1 text-gray-700 dark:text-white" for="last_name">
								Last Name
							</label>
							<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" wire:model="last_name" id="last_name" type="text">
							</input>
							@error('last_name')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
					</div>
					<div class="mt-4">
						<label class="block mb-1 text-gray-700 dark:text-white" for="phone">
							Phone
						</label>
						<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="phone" wire:model="phone" type="text">
						</input>
						@error('phone')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="mt-4">
						<label class="block mb-1 text-gray-700 dark:text-white" for="address">
							Address
						</label>
						<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="street_address" wire:model="street_address" type="text">
						</input>
						@error('street_address')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="mt-4">
						<label class="block mb-1 text-gray-700 dark:text-white" for="city">
							City
						</label>
						<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="city" wire:model="city" type="text">
						</input>
						@error('city')
							<span class="text-red-500">{{$message}}</span>
						@enderror
					</div>
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div>
							<label class="block mb-1 text-gray-700 dark:text-white" for="state">
								State
							</label>
							<select class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="state" wire:model="state">
								<option value="">Select State</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
							@error('state')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
						<div>
							<label class="block mb-1 text-gray-700 dark:text-white" for="zip_code">
								ZIP Code
							</label>
							<input class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none" id="zip_code" wire:model="zip_code" type="text">
							</input>
							@error('zip_code')
								<span class="text-red-500">{{$message}}</span>
							@enderror
						</div>
					</div>
				</div>
				<div class="mb-4 text-lg font-semibold">
					Select Payment Method
				</div>
				<ul class="grid w-full gap-6 md:grid-cols-2">
					<li>
						<input class="hidden peer" id="hosting-small" type="radio" value="hosting-small" />
						<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
							<div class="block">
								<div class="w-full text-lg font-semibold">
									Cash on Delivery
								</div>
							</div>
							<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
								</path>
							</svg>
						</label>
					</li>
					<li>
						<input class="hidden peer" id="hosting-big" type="radio" value="hosting-big">
						<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
							<div class="block">
								<div class="w-full text-lg font-semibold">
									Stripe
								</div>
							</div>
							<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
								</path>
							</svg>
						</label>
						</input>
					</li>
				</ul>
			</div>
			<!-- End Card -->
		</div>
		<div class="col-span-12 md:col-span-12 lg:col-span-4">
			<div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
				<div class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
					ORDER SUMMARY
				</div>
				<div class="flex justify-between mb-2 font-bold">
					<span>
						Subtotal
					</span>
					<span>
						{{Number::currency($grandTotal)}}
					</span>
				</div>
				<div class="flex justify-between mb-2 font-bold">
					<span>
						Taxes
					</span>
					<span>
						0.00
					</span>
				</div>
				<div class="flex justify-between mb-2 font-bold">
					<span>
						Shipping Cost
					</span>
					<span>
						0.00
					</span>
				</div>
				<hr class="h-1 my-4 rounded bg-slate-400">
				<div class="flex justify-between mb-2 font-bold">
					<span>
						Grand Total
					</span>
					<span>
						45,000.00
					</span>
				</div>
				</hr>
			</div>
			<button type="submit" class="w-full p-3 mt-4 text-lg text-white bg-orange-600 rounded-lg hover:bg-orange-400">
				<span wire:loading.remove wire:target="submitOrder">Place Order</span>
				<span wire:loading wire:target="submitOrder">Processing...</span>
			</button>
			<div class="p-4 mt-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
				<div class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
					BASKET SUMMARY
				</div>
				<ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
					@foreach ($items as $item)
					<li class="py-3 sm:py-4">
						<div class="flex items-center">
							<div class="flex-shrink-0">
								<img alt="{{$item['name']}}" class="w-12 h-12 rounded-full" src="{{url('storage',$item['image'])}}">
								</img>
							</div>
							<div class="flex-1 min-w-0 ms-4">
								<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
									{{$item['name']}}
								</p>
								<p class="text-sm text-gray-500 truncate dark:text-gray-400">
									{{$item['quantity']}}
								</p>
							</div>
							<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
								{{Number::currency($item['totalAmount'])}}
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</form>
</div>